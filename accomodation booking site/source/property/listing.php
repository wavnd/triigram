<?php

  include '../partials/header.php';
  include __ROOT__ . '/database/venue-helper.php';

  $conn = new db();
  if (isset($_POST['listing'])) {
      $listing = $_POST['listing'];
  } else {
      $listing = '1';
  }

  if (isset($_POST['rating']) && isset($_POST['review']) && isset($_POST['user'])) {
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $user = $_POST['user'];
    $result2 = $conn->searchHostId($user);
    $userow = $result2[0];
    $conn->addUserReview($user,$listing,$review,$rating,$userow->Picture);
  }
  $row = NULL;
  $userow = NULL;
  $result1 = $conn->searchListingId($listing);
  $row = $result1[0];
  $result2 = $conn->searchHostId($row->Host);
  $result3 = $conn->getListingReviews($listing);
  $userow = $result2[0];
  generateDetails($row,$userow,$result3);
