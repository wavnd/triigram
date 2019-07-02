var fs = require('fs');

//create readeable stream
var readerStream = fs.createReadStream('meet.txt');

//create reader stream
var writerStream = fs.createWriteStream('pipeme.txt');

//pipe the read and write operations
readerStream.pipe(writerStream);

console.log('Program end');
