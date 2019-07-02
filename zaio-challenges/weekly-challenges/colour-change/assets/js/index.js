console.log('inside script');

//executed when the blue div is clicked
//jQuery event listener
$("#btn-blue").on("click", function() {
    var color = "Blue";
    var sum = 0;
    //splits the letters of the colour name into an array 'c'
    //loops through each letter and finds its corresponding ASCII while adding
    //them up
    color.split('').forEach(function(c){
        sum = sum+c.charCodeAt(0);
    });
    $(".description").html("<p></p>");
    //changes the CSS (background) properties for the element with id --> text-block
    //to the colour variable
    $("#text-block").css("background-color", color);
    //replaces default html with new one that contains the color variable to
    //display it along with paragraph
    $('.message').html("<p>hi, my name is "+color+"</p>");
    //replaces default 'calculations' text with the corresponding ASCII sum of
    //corresponding colour
    $(".calc").html("<p>"+sum+"</p>");
});

$("#btn-green").on("click", function() {
    var color = "Green";
    var sum = 0;
    color.split('').forEach(function(c){
        sum = sum+c.charCodeAt(0);
    });
    $(".description").html("<p></p>");
    $("#text-block").css("background-color", color);
    $(".message").html("<p>hi, my name is Green<p>");
    $(".calc").html("<p>"+sum+"</p>");
});

$("#btn-red").on("click", function() {
    var color = "Red";
    var sum = 0;
    color.split('').forEach(function(c){
        sum = sum+c.charCodeAt(0);
    });
    $(".description").html("<p></p>");
    $("#text-block").css("background-color", color);
    $(".message").html("<p>hi, my name is Red</p>");
    $(".calc").html("<p>"+sum+"</p>");
});
