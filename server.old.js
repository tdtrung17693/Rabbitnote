var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var request = require('request');
var client = require('socket.io-client');

var redis = new Redis();
var rate = 1.0;
var per = 2.0;
var allowance = rate;
var last_check = (new Date()).getTime();

io.on('connection', function (socket) {
    socket.on('new_note', function (data, fn) {
        current = (new Date()).getTime();
        time_passed = current - last_check;
        last_check = current;
        allowance += time_passed * (rate * 0.001 / per);

        if (allowance > rate) {
            allowance = rate;
        }

        if (allowance < 1.0) {
            console.log('exceed');
        } else {
            addNote(data._key, data.data, fn);
            allowance -= 1.0;
        }
    });

    socket.on('trash_note', function (data) {
        current = (new Date()).getTime();
        time_passed = current - last_check;
        last_check = current;
        allowance += time_passed * (rate * 0.001 / per);

        if (allowance > rate) {
            allowance = rate;
        }

        if (allowance < 1.0) {
            console.log('exceed');
        } else {
            trashNote(data._key, data.data);
            allowance -= 1.0;
        }
    });
});

function trashNote(key, data) {
    request({
        url: `http:\/\/127.0.0.1/api/notes/${data.id}`,
        method: 'DELETE',
        qs: {
            note: data
        },
        headers: {
            Authorization: `Bearer ${key}`,
            Accept: 'application/json'
        }
    }, function (err, res, body) {
        if (res.statusCode !== 200) {
            io.emit('server_error', res);
        } else {
            console.log(res);
        }
    });
}

function addNote(key, data, fn) {
    request({
        url: 'http://127.0.0.1/api/notes',
        method: 'POST',
        qs: {
            note: data
        },
        headers: {
            Authorization: `Bearer ${key}`,
            Accept: 'application/json'
        }
    }, function (err, res, body) {
        if (err) {
            console.log(err);
        } else {
            console.log(res.statusCode, body);
            fn(true);
        }
    });
}

redis.on('message', function (channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(3000, function () {
    console.log('Listening on Port 3000');
});
