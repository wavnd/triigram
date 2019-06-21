from flask import Blueprint, render_template, redirect, url_for, flash
from flask_login import login_required, current_user

from twitter_lite.business import TweetHandler
from twitter_lite.forms import tweet

tweet_routes = Blueprint('tweet', __name__, template_folder='../templates')

tweetHandler = TweetHandler()


@tweet_routes.route('/create_tweet', methods=['GET', 'POST'])
@login_required
def new():
    form = tweet()

    if form.validate_on_submit():
        # can be added later for the tweet title if you guys want to
        content = form.content.data
        tweetHandler.add_new_tweet(content, current_user)
        flash('You Tweeted! :)', 'success')
        return redirect(url_for('home.index'))
    image_file = url_for('static', filename='images/' + current_user.profile_pic_url)
    return render_template('create_tweet.html', title='Create Tweet', form=form, image_file=image_file)


@tweet_routes.route('/tweet/retweet/<tweet_id>', methods=['PUT'])
@login_required
def retweet(tweet_id: str):
    tweetHandler.re_tweet(tweet_id, current_user)
    return json.dumps({'success':True}), 200, {'ContentType':'application/json'}


@tweet_routes.route('/tweet/like/<tweet_id>', methods=['PUT'])
@login_required
def like(tweet_id: str):
    tweetHandler.like_tweet(tweet_id, current_user)
    return json.dumps({'success': True}), 200, {'ContentType': 'application/json'}

