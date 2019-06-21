// Get the elements with class="os-column"
var elements = document.getElementsByClassName("os-column");
var myVar;
// List View
function listView() {
  for (var i = 0; i < elements.length; i++) {
    elements[i].style.width = "100%";
  }
}

// Grid View
function gridView() {
  for (var i = 0; i < elements.length; i++) {
    elements[i].style.width = "50%";
  }
}

/* loader functionality */
function delayMap() {
  myVar = setTimeout(showMap, 1000);
}

function showMap() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}