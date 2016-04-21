import Socket from 'socket.io-client';

var socketUrl = 'http://rabbitnote.dev:3000';
var io = new Socket(socketUrl);

export default io;
