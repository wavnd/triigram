var fs = require('fs');

var data = '';

//create readable stream
var readerStream = fs.createReadStream('input.txt');

//set encoding to utf-8
readerStream.setEncoding('utf-8');

//handle stream events ----> data, end, err
readerStream.on('data', function(chunk){
    data = data+chunk;
});

readerStream.on('end', function(){
    console.log(data);
});

readerStream.on('error', function(err){
    console.log(err.stack);
});
console.log('Program ended');
