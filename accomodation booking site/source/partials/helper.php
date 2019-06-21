<?php
function getReviews($id)
{
    $db = new db();
    $reviews = $db->getReviewsByListing($id);

    echo('<h2>Reviews</h2>');
    if (!$reviews) {
        echo('<h3>NO REVIEWS</h3>');
    } else {
        echo('<table>');
        echo('<thead>');
        echo('<tr>');
        echo('<th scope="col">ID</th>');
        echo('<th scope="col">Created At</th>');
        echo('<th scope="col">Guest</th>');
        echo('<th scope="col">Rating</th>');
        echo('<th scope="col">Review</th>');
        echo('</tr>');
        echo('</thead>');
        echo('<tbody>');
        foreach ($reviews as $review) {
            echo('<tr>');
            echo('<td>' . $review->ID . '</td>');
            echo('<td>' . $review->Created_At . '</td>');
            echo('<td>' . $review->Guest . '</td>');
            echo('<td>' . $review->Rating . '</td>');
            echo('<td>' . $review->Review . '</td>');
            echo('</tr>');
        }
        echo('</tbody>');
        echo('</table>');
    }
}
