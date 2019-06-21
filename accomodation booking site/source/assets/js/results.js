let price_thumb;
let ratings_thumb;
let new_ratings_value;
let price_value;
let ratings_value;
let guest_value;
let accommodation_value;
let sort_value;
let amenties_value;
let place_name;
let searchInput;
let searchResult;
let ajax;
let rootPath;

//searchInput = document.getElementById('secondSearchInput');
//searchResult = document.getElementById('secondSearchResults');
ajax = null;

function setRootPath(path) {
  rootPath = path;
}
function setPlace(pl) {
  place_name = pl;
}
/**
 * Aligns the footer
 */
function alignFooter(i) {
    let temp = document.getElementsByClassName('footer')[0];
    let temp2 = document.getElementsByClassName('filters')[0];
    temp.style.marginLeft = -(document.body.offsetWidth * 0.1) + 'px';
    temp.style.width = document.body.offsetWidth + 'px';
//    temp.style.position = 'absolute';
    //temp.style.top = temp2.offsetHeight+202+'px';
    if (i === 0 || i === '0' || i === "0") {
      temp.style.float = 'left';
      temp.style.marginTop ='5.0em';
    }
}

/**
 * Idealizes the Filters
 * @param a
 * @param b
 * @param c
 * @param d
 */
function initialize_filters(a, b, c, d, e, f) {
    let i;

//    searchInput = document.getElementById('secondSearchInput');
//    searchResult = document.getElementById('secondSearchResults');
    ajax = null;

    if (e === -1) {
      document.getElementById('price').value = 10000;
    } else {
      document.getElementById('price').value = e;
    }
    if (f === -1) {
      document.getElementById('ratings').value = 0;
    } else {
      document.getElementById('ratings').value = f;
    }
    price_value = e;
    ratings_value = f;
    guest_value = a;
    accommodation_value = b;
    sort_value = c;
    amenties_value = parseInt(d);
    updateNumberOfGuests(a);
    updateAccommodation(b);
    updateSort(c);
    updatePrice();
    updateRatings();
    if (amenties_value !== 0) {
      for(i = 0; i < 24; i = i+1) {
          if ((amenties_value & (Math.pow(2, i))) !== 0) {
          updateAmenities(i+1);
        }
      }
    }
}

/**
 * remove the price filter
 */
function cancellPrice() {
    document.getElementById('price').value = 10000;
    updatePrice();
}

/**
 * removes the rating filter
 */
function cancellRatings() {
    document.getElementById('ratings').value = 0.0;
    updateRatings();
}

/**
 * Updates the price
 */
function updatePrice() {
    price_value = document.getElementById('price').value;
    price_thumb = document.getElementById('priceThumb');

    if (price_value >= 10000) {
        price_thumb.innerHTML = "R " + price_value + "+";
    } else {
        price_thumb.innerHTML = "R " + price_value;
    }
    price_thumb.style.left = ((price_value / 10000) * 100) + "%";
    price_thumb.style.marginLeft = -((price_value / 10000) * 50) + "px";
}

/**
 * updates the ratings
 */
function updateRatings() {
    ratings_value = document.getElementById('ratings').value;
    ratings_thumb = document.getElementById('ratingsThumb');
    new_ratings_value = document.getElementById('ratingsValue');
    new_ratings_value.innerHTML = (ratings_value / 10) * 5;
    ratings_thumb.style.left = ((ratings_value / 10) * 100) + "%";
    ratings_thumb.style.marginLeft = -((ratings_value / 10) * 50) + "px";
}

/**
 * Highlights the element
 * @param ele
 */
function highlightoption(ele) {
    ele.style.backgroundColor = '#BFEFFF';
}

/**
 * Makes the element fade
 * @param ele
 */
function lowlightoption(ele) {
    ele.style.backgroundColor = '#FFFFFF';
}

/**
 * Updates the number of guests
 * @param y
 */
function updateNumberOfGuests(y) {
    let temp = document.getElementsByClassName('number-of-guests-options');
    let i;
    for (i = 0; i < 5; i++) {
        temp[i].style.backgroundColor = '#FFFFFF';
    }
    guest_value = y;
    if (y === 0) {
        return;
    }
    temp[(y - 1)].style.backgroundColor = '#BFEFFF';
}

/**
 * Updates the accommodation
 * @param y
 */
function updateAccommodation(y) {
    let temp = document.getElementsByClassName('number-accommodation-options');
    let i;
    for (i = 0; i < 4; i++) {
        temp[i].style.backgroundColor = '#FFFFFF';
    }
    accommodation_value = y;
    if (y === 0) {
        return;
    }
    temp[(y - 1)].style.backgroundColor = '#BFEFFF';
}

/**
 * Updates the sort
 * @param y
 */
function updateSort(y) {
    let temp = document.getElementsByClassName('number-sort-options');
    let i;
    for (i = 0; i < 3; i++) {
        temp[i].style.backgroundColor = '#FFFFFF';
    }
    sort_value = y;
    if (y === 0) {
        return;
    }
    temp[(y - 1)].style.backgroundColor = '#BFEFFF';
}

/**
 * Updates the Amenities
 * @param y
 */
function updateAmenities(y) {
    let temp = document.getElementsByClassName('number-ammenities-options');
    let i;
    if (y === 0) {
        for (i = 0; i < 24; i++) {
            temp[i].style.backgroundColor = '#FFFFFF';
        }
        return;
    }
    if (temp[(y - 1)].style.backgroundColor === 'rgb(191, 239, 255)') {
        temp[(y - 1)].style.backgroundColor = '#FFFFFF';

    } else {
        temp[(y - 1)].style.backgroundColor = '#BFEFFF';

    }
}

/**
 * returns all the Amenities
 */
function allAmmenities() {
    let temp = document.getElementsByClassName('number-ammenities-options');
    let i;
    amenties_value = 0;
    for (i = 0; i < 24; i++) {
        if (temp[i].style.backgroundColor === 'rgb(191, 239, 255)') {
            amenties_value = amenties_value + Math.pow(2,i);
        }
    }
}
function PreviousButton(offset,searchtype) {
  offset = offset - 10;
  if (offset <= 0) {
    offset = 0;
  }
  nextsearch(offset,searchtype);
}
function NextButton(offset,searchtype) {
  offset = offset + 10;
  if (offset <= 0) {
    offset = 0;
  }
  nextsearch(offset,searchtype);
}


/**
 * gets the next search
 */
function nextsearch(offset,searchtype) {
    allAmmenities();
    let form = document.createElement("form");
    let element1 = document.createElement("input");
    let element2 = document.createElement("input");
    let element3 = document.createElement("input");
    let element4 = document.createElement("input");
    let element5 = document.createElement("input");
    let element6 = document.createElement("input");
    let element7 = document.createElement("input");
    let element8 = document.createElement("input");
    let element9 = document.createElement("input");

    form.method = "POST";
    form.action = "results.php";

    element1.value=price_value;
    element1.name="price";
    form.appendChild(element1);

    element2.value=ratings_value;
    element2.name="ratings";
    form.appendChild(element2);

    element3.value=guest_value;
    element3.name="guests";
    form.appendChild(element3);

    element4.value=accommodation_value;
    element4.name="type";
    form.appendChild(element4);

    element5.value=sort_value;
    element5.name="sort";
    form.appendChild(element5);

    element6.value=amenties_value;
    element6.name="amenties";
    form.appendChild(element6);

    element7.value=place_name;
    element7.name="place";
    form.appendChild(element7);

    element8.value=offset;
    element8.name="offset";
    form.appendChild(element8);

    element9.value=searchtype;
    element9.name="searchType";
    form.appendChild(element9);

    document.body.appendChild(form);

    form.submit();
}

function thelivesearch(place,searchtype) {
    let form = document.createElement("form");
    let element1 = document.createElement("input");
    let element2 = document.createElement("input");

    form.method = "POST";
    form.action = "results.php";

    element1.value=place;
    element1.name="place";
    form.appendChild(element1);

    element2.value=searchtype;
    element2.name="searchType";
    form.appendChild(element2);

    document.body.appendChild(form);

    form.submit();
}

function thelivesearch(ele){
  searchResult = document.getElementById('secondSearchResults');

    let theSearch = ele.value.replace(/^\s|\s+$/, "");
	if ( theSearch !== "" && theSearch !== null) {
		searchForThePlace(theSearch);
	} else {
		searchResult.innerHTML = '';
	}
}

function clearReasults() {
  searchResult = document.getElementById('secondSearchResults');
	searchResult.innerHTML = '';
}

function searchForThePlace(value) {
  searchResult = document.getElementById('secondSearchResults');
  if (ajax && typeof ajax.abort === 'function') {
		ajax.abort();
	}
	ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
		if (this.readyState === 4 && this.status === 200) {
			try {
        searchResult.innerHTML = this.responseText;
			} catch (e) {
				searchResult.innerHTML = 'Sorry no match for your search ;-)';
			}
		} else {
            searchResult.innerHTML = 'Sorry! something went wrong with your search<br>';
        }
    };
	ajax.open('POST', '/assets/php/searchresults.php', true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("place=" + value);
}
function viewsearch(listingID,hostID) {
    let form = document.createElement("form");
    let element1 = document.createElement("input");
    let element2 = document.createElement("input");

    form.method = "POST";
    form.action = "listing.php";
    element1.value=listingID;
    element1.name="listing";
    form.appendChild(element1);
    element2.value=hostID;
    element2.name="host";
    form.appendChild(element2);
    document.body.appendChild(form);
    form.submit();
}
