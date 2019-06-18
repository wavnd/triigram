/**
 * I (Yarince) am still working on this. But the plan is to add the functions for ajax calls here.
 * I have to do some proper research to see how it works tho
 */


function likeTweet(tweetid) {
    $.ajax({
        type: "PUT",
        url: "/tweet/like/" + tweetid,
        success: function () {
            // TODO Set like button to diffrent color
            location.reload();
        },
    });
}

function retweet(tweetid) {
    $.ajax({
        type: "PUT",
        url: "/tweet/retweet/" + tweetid,
        success: function () {
            // TODO Set retweet button to diffrent color
            console.log("tweet " + tweetid + " retweeted")
        },
    });
}

function follow(username) {
    $.ajax({
        type: "POST",
        url: "/user/follow/" + username,
        success: function () {
            location.reload();
        },
    });
}

function unfollow(username) {
    $.ajax({
        type: "POST",
        url: "/user/unfollow/" + username,
        success: function () {
            location.reload();
        },
    });
}
