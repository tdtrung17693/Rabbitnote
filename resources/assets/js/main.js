import Vue from 'vue';
import VueResource from 'vue-resource';
import App from './App.vue';
import Storage from 'localforage';

Vue.config.debug = true;
Vue.use(VueResource);

Vue.http.options.root = "http://api.rabbitnote.dev";

Vue.http.headers.common['Accept'] = 'application/x.notes.v1+json';

Vue.http.interceptors.push({
	request(r) {
		let token = '',
			gotToken = false;

		return Storage
			.getItem('token')
			.then(t => {
				if (t !== null) {
					Vue.http.headers.common.Authorization = `Bearer ${t}`;
				}

				return Promise.resolve(r);
			})
			.catch(() => console.log('Storage I/O Error'));
	},
	response(r) {
		if (r.status === 400 || r.status === 401) {
			if (r.request.method !== 'POST' && r.request.url !== 'auth') {
				App.logout();
			}
		}

		if (r.headers && r.headers.Authorization) {
            Storage.setItem('token', r.headers.Authorization);
        }

        if (r.data && r.data.token && r.data.token.length > 10) {
            Storage.setItem('token', r.data.token);
        }

        return r;
	}
});


new Vue(App).$mount('body');
