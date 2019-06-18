let slideIndex = 1;
showSlides(slideIndex);
alignFooter2();

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
function alignFooter2() {
    let temp = document.getElementsByClassName('footer')[0];
    temp.style.marginLeft = -(document.body.offsetWidth * 0.1) + 'px';
    temp.style.width = document.body.offsetWidth + 'px';
    temp.style.position = 'relative';
}
function updateRatingsReview() {
    ratings_value = document.getElementById('ratingsReview').value;
    new_ratings_value = document.getElementById('ratingsValueReview');
    new_ratings_value.innerHTML = (ratings_value / 10) * 5;
}
function myMap(x,y) {
    let mapProp = {
    center:new google.maps.LatLng(x,y),
    zoom:5,
  };
    let map = new google.maps.Map(document.getElementById("gmap_canvas"), mapProp);
}
function doreview(listingID) {
    let form = document.createElement("form");
    let element1 = document.createElement("input");
    let element2 = document.createElement("input");
    let element3 = document.createElement("input");
    let element4 = document.createElement("input");


    form.method = "POST";
    form.action = "../database/DBClient.php";

    element1.value="Create Review";
    element1.name="form";
    form.appendChild(element1);

    element2.value=listingID;
    element2.name="listing";
    form.appendChild(element2);

    element3.value=document.getElementById('reviewText').value;
    element3.name="review";
    form.appendChild(element3);

    element4.value=document.getElementById('ratingsReview').value;
    element4.name="rating";
    form.appendChild(element4);

    document.body.appendChild(form);
    form.submit();
}
