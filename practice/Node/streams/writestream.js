var fs = require('fs');
var data = 'Simple learning';

//creats writeable stream
var writerStream = fs.createWriteStream('output.txt');

//writes data to to stream with utf-8 encoding
writerStream.write(data, 'utf-8');

//mark end of file
writerStream.end();

//handle stream events --> finish, error

writerStream.on('finish', function(){
    console.log('write complete');
});

writerStream.on('error', function(err){
    console.log(err.stack);
});
