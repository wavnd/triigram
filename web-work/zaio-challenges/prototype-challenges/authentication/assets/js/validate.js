/**
validation for the registeration page
**/
function validateRegister(){
    console.log("Im inside the JS");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname").value;
    var email = document.getElementById("email").value;
    var age = document.getElementById("age").value;
    var pass = document.getElementById("pass").value;
    var passconf = document.getElementById("passconf").value;


    if(pass === passconf){
        var details = [fname,lname, age, email, pass, passconf];
        alert("Success");
    }else {
        alert("Passwords do not match");
    }
}
