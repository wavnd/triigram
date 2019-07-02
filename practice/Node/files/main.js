//reads the file asynchronously
//thus makes use of call back, none blocking code
var fs = require("fs");
fs.readFile('input.txt', function(err, data){
    if(err){
        console.log(err);
    }
    console.log('Async reads: '+data.toString());
})
console.log("End Async program");
//------------------------------------------------------------------------------

//synchronous code, blocking code
//reads the file before moving on to next code
var data = fs.readFileSync('input.txt');
console.log("Sync reads: "+data.toString());
console.log("End Sync Program");
console.log('-------------------------------------------------------');
//------------------------------------------------------------------------------
//opening a file
console.log('Going to open file');
fs.open('input.txt', 'r+', function(err, fd){
    if (err){
        console.log(err.stack);
    }
    console.log('File open successfully');

    console.log('-------------------------------------------------------');
});
//-----------------------------------------------------------------------------
//get file info
console.log('Going to get file info');
fs.stat('input.txt', function(err, stats){
    if(err){
        console.log(err.stack);
    }
    console.log(stats);
    console.log('Is File? '+stats.isFile());
    console.log('Is Directory? '+stats.isDirectory());

    console.log('-------------------------------------------------------');
});
