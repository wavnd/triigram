//creates HTTP server which listens, i.e waits for a request over port
//8081 on the local machine


var http = require("http");
http.createServer(function (request, response) {
    //send http header
    //http status 200: OK
    //Content type: text/plain
    response.writeHead(200, {'Content-Type': 'text/plain'});

    //send repsonse body as 'Hello World'
    response.end('Hello world\n');
}).listen(8081);


//Console will print the message
console.log('Server running at http://127.0.0.1:8081/');
