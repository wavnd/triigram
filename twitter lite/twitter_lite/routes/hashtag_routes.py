from flask import render_template, Blueprint, redirect, url_for, flash, request, jsonify
from flask_login import current_user, login_required
import os
from twitter_lite import login_manager
from twitter_lite.business import TweetHandler, HashTagHandler, UserHandler
from twitter_lite.forms import UpdateProfileForm
from werkzeug.utils import secure_filename

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
hashtag_routes = Blueprint('hashtags_search', __name__, template_folder='../templates')

# The creation of the used business classes
tweetHandler = TweetHandler()
hashTagHandler = HashTagHandler()
userHandler = UserHandler()


# See we're using home_routes as a variable here. That is so it can communicate with the flask app once it is registered
# in the `create_app()` function
@hashtag_routes.route('/hashtags_search', methods=['GET', 'POST'])
@login_required
def hashtag():
    # Checks if there is currently a user logged in for a session
    if current_user.is_authenticated:
        # Send data to the template file `profile.html`
        # Default image will change to current_user.image_url

        my_tweet = hashTagHandler.get_tweets_by_tag(request.args.get('tag_name'))
        return render_template('hashtags_search.html', logged_in=True, tweets=my_tweet,
                               tag=request.args.get('tag_name'))
    else:
        return render_template('index.html', logged_in=False)


# A default endpoint for unauthorized requests
@login_manager.unauthorized_handler
def unauthorized():
    """Redirect unauthorized users to Login page."""
    flash('You must be logged in to view that page.')
    return redirect(url_for('login.login'))
