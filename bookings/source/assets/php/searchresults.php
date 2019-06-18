<?php
define('__ROOT__', dirname(dirname(dirname(__FILE__))));
include __ROOT__ . '/database/results-helper.php';
include __ROOT__ . '/database/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new db();

if (isset($_POST['place'])) {
    $place = $_POST['place'];
} else {
    $place = '';
    echo "type something";
}

$resultA = $conn->searchTitle($place);
$resultB = $conn->searchLocation($place);
if (count($resultA) == 0 && count($resultB) == 0 ) {
  echo "No match for:".$place;
}
foreach ($resultA as $row) {
    titleResults($row);
}
foreach ($resultB as $row) {
    locationResults($row);
}
