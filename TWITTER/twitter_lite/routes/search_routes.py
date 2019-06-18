from flask import render_template, Blueprint, redirect, url_for, flash
from flask_login import current_user

from twitter_lite import login_manager
from twitter_lite.business import TweetHandler, HashTagHandler, UserHandler
from twitter_lite.forms import searchBar

search_routes = Blueprint('search', __name__, template_folder='../templates')

# The creation of the used business classes
tweetHandler = TweetHandler()
hashTagHandler = HashTagHandler()
userHandler = UserHandler()

@search_routes.route('/search', methods=['GET', 'POST'])
def search():
    # Checks if there is currently a user logged in for a session
    if current_user.is_authenticated:
        # Get searchBar form
        form = searchBar()
        # Get homepage data
        #tweets = tweetHandler.get_tweets_of_followers(current_user)
        # tweets_by_current_user = tweetHandler.get_total_tweets_by_user(current_user)
        #    recommendations = userHandler.get_recommendations_for_followers(current_user)
        #top5_hash_tags = hashTagHandler.get_top5_hash_tags()
        # Send data to the template file `index.html`
        if form.validate_on_submit():
            username=form.search.data

            if userHandler.does_user_exist(username):
                user = userHandler.get_user(username)
                return redirect(url_for('user_info.profile', username=user.username))
            else:
                flash('User Does not exist', 'warning')
                
        return render_template('search.html', logged_in=True, user=current_user, form=form)
    else:
        return render_template('index.html', logged_in=False)

