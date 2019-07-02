var fs = require('fs');
var zlib = require('zlib');

//compress the file
fs.createReadStream('meet.txt').pipe(zlib.createGzip()).pipe(fs.createWriteStream('meet.txt.gz'));

console.log('File compressed');

//decompress same file
fs.createReadStream('meet.txt.gz').pipe(zlib.createGunzip()).pipe(fs.createWriteStream('meet.txt'));
console.log('File decompressed');
