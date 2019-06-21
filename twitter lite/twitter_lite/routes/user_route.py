import json

from flask import render_template, Blueprint, redirect, url_for, flash, request
from flask_login import current_user, login_required

from twitter_lite import login_manager
from twitter_lite.business import TweetHandler, HashTagHandler, UserHandler

"""
Profile routes

In this file the data for the index/home page is loaded from the business layer

Every route is split up in small per subject files to keep everything easily editable and it also 
decreases git conflicts

If you want to add a route you need to add it to the `__init__.py` of this directory and to the `create_app.py` file
just like the current route

"""

# Register the route in flask. Here it is given a name and some default properties. The template folder is specified
# because routes can also have their own template sub folder
user_route = Blueprint('user_info', __name__, template_folder='../templates')

# The creation of the used business classes
tweetHandler = TweetHandler()
hashTagHandler = HashTagHandler()
userHandler = UserHandler()


# See we're using home_routes as a variable here. That is so it can communicate with the flask app once it is registered
# in the `create_app()` function
@user_route.route('/user_info', methods=['GET', 'POST'])
@login_required
def profile():
    # Checks if there is currently a user logged in for a session
    if current_user.is_authenticated:
        # Send data to the template file `profile.html`
        # Default image will change to current_user.image_url
        next_user = userHandler.get_user(request.args.get('username'))
        my_tweet = tweetHandler.load_tweets_by_user(request.args.get('username'))
        is_followed = userHandler.is_followed_by_user(current_user, next_user)
        return render_template('user_info.html', logged_in=True, user=next_user, tweets=my_tweet,
                               is_followed=is_followed)
    else:
        return render_template('index.html', logged_in=False)


@user_route.route('/user/follow/<username>', methods=['POST'])
@login_required
def follow(username: str):
    userHandler.follow_user(current_user, username)
    return json.dumps({'success': True}), 200, {'ContentType': 'application/json'}


@user_route.route('/user/unfollow/<username>', methods=['POST'])
@login_required
def unfollow(username: str):
    userHandler.unfollow_user(current_user, username)
    return json.dumps({'success': True}), 200, {'ContentType': 'application/json'}


# A default endpoint for unauthorized requests
@login_manager.unauthorized_handler
def unauthorized():
    """Redirect unauthorized users to Login page."""
    flash('You must be logged in to view that page.')
    return redirect(url_for('login.login'))
