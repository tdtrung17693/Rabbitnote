import Socket from 'socket.io-client';
import Event from '../eventbus';

var socketUrl = 'http://rabbitnote.dev:3000';
var io = new Socket(socketUrl);
window.io = io;
console.log(io);
export default {
    instance: null,

    init() {
        this.instance = new Socket(socketUrl);
        return this;
    },

    listenToUser(userId) {
        console.log(`Listening to user with id ${userId}`);
        this.instance.on(`user-${userId}:notes:saved`, data => {
            Event.emit(`note:saved`, data);
        });
    }
};
