import SocketIO from 'socket.io-client';
import Vue from 'vue';
import VueResource from 'vue-resource';
import App from './App.vue';

window.socket = SocketIO('http://homestead.app:3000');

Vue.use(VueResource);
new Vue(App).$mount('body');
