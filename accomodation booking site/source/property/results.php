<?php
include '../partials/header.php';
include __ROOT__ . '/database/results-helper.php';

$conn = new db();
if (isset($_POST['place'])) {
    $place = $_POST['place'];
} else {
    $place = '';
}
if (isset($_POST['price'])) {
    $price = $_POST['price'];
} else {
    $price = -1;
}
if (isset($_POST['ratings'])) {
    $ratings = $_POST['ratings'];
} else {
    $ratings = -1;
}

if (isset($_POST['guests'])) {
    $guests = (int)$_POST['guests'];
} else {
    $guests = 0;
}
if (isset($_POST['type'])) {
    $type = (int)$_POST['type'];
} else {
    $type = 0;
}
if (isset($_POST['sort'])) {
    $sort = (int)$_POST['sort'];
} else {
    $sort  = 1;
}
if (isset($_POST['amenties'])) {
    $amenities = (int)$_POST['amenties'];
} else {
    $amenities = 0;
}
if (isset($_POST['offset'])) {
    $offset = (int) $_POST['offset'];
} else {
    $offset = 0;
}
if (isset($_POST['searchType'])) {
    $searchType = (int) $_POST['searchType'];
} else {
    $searchType = 0;
}

setHeaderForResults();
setFilters($offset);

if ($searchType == 1) {
  $result = $conn->searchRatings('S', $offset,$guests,$type,$sort,$amenities,$ratings);
} elseif ($searchType == 2) {
  $result = $conn->searchPrice('S', $offset,$guests,$type,$sort,$amenities,$price);
} elseif ($searchType == 3) {
  $result = $conn->searchLocation($place);
} elseif ($searchType == 4)  {
  $result = $conn->searchTitle($place);
} else {
  $result = $conn->searchName('S', $offset,$guests,$type,$sort,$amenities);
}

foreach ($result as $row) {
    manageResult($row);
}
$allign = setFooterForResults(count($result),$offset,$searchType);
include '../partials/footer.php';
endResult($guests,$type,$sort,$amenities,$price,$ratings,$allign,$place);
