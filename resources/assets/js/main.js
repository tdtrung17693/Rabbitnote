import Vue from 'vue';
import VueResource from 'vue-resource';
import App from './App.vue';

Vue.config.debug = true;
Vue.use(VueResource);
Vue.http.interceptors.push({
    request(r) {
        Vue.http.headers.common.Accept = 'application/x.notes.v1+json';
        Vue.http.headers.common.Authorization = `Bearer ${key}`;

        return r;
    },

    response(r) {
        return r;
    },
});
new Vue(App).$mount('body');
