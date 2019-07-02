//import event module
var events = require('events');

//create event emittter object
var eventEmitter = new events.EventEmitter();

//create event handler
var connectHandler = function(){
    console.log('Connect successful');

    //fire up the data_received event
    eventEmitter.emit('data_received');
}

//bind connection event with event handler
eventEmitter.on('connection', connectHandler);

//bind the data_received event with  anonymous function
eventEmitter.on('data_received', function(){
    console.log('data received successfully');
});

//fire up the connection event
eventEmitter.emit('connection');
console.log('Program ended.');
