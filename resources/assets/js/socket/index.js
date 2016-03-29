import Socket from 'socket.io-client';

var socketUrl = 'http://homestead.app:3000';
var io = new Socket(socketUrl);

export default io;
