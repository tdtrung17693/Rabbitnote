import Vue from 'vue';

let storeUrl = 'http://api.rabbitnote.dev';

var notes = [];

export default {
	init(successCb = null, errorCb = null) {
		Vue.http['get'](storeUrl + '/users/1/notes').then(successCb, errorCb);
	}
}
