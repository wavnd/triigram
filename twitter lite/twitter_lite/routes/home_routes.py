from flask import render_template, Blueprint, redirect, url_for, flash
from flask_login import current_user

from twitter_lite import login_manager
from twitter_lite.business import TweetHandler, HashTagHandler, UserHandler
from twitter_lite.forms import searchBar

"""
Home routes

In this file the data for the index/home page is loaded from the business layer

Every route is split up in small per subject files to keep everything easily editable and it also
decreases git conflicts

If you want to add a route you need to add it to the `__init__.py` of this directory and to the `create_app.py` file
just like the current route

"""

# Register the route in flask. Here it is given a name and some default properties. The template folder is specified
# because routes can also have their own template sub folder
home_routes = Blueprint('home', __name__, template_folder='../templates')

# The creation of the used business classes
tweetHandler = TweetHandler()
hashTagHandler = HashTagHandler()
userHandler = UserHandler()


# See we're using home_routes as a variable here. That is so it can communicate with the flask app once it is registered
# in the `create_app()` function
@home_routes.route('/')
def index():
    # Checks if there is currently a user logged in for a session
    if current_user.is_authenticated:
        # Get searchBar form
        form = searchBar()
        # Get homepage data
        tweets = tweetHandler.get_tweets_of_followers(current_user)
        # tweets_by_current_user = tweetHandler.get_total_tweets_by_user(current_user)
        #    recommendations = userHandler.get_recommendations_for_followers(current_user)
        top5_hash_tags = hashTagHandler.get_top5_hash_tags()
        # Send data to the template file `index.html`

        return render_template('index.html', logged_in=True, user=current_user, tweets=tweets, form=form,
                               tags=top5_hash_tags)
    else:
        return render_template('index.html', logged_in=False)


# A default endpoint for unauthorized requests
@login_manager.unauthorized_handler
def unauthorized():
    """Redirect unauthorized users to Login page."""
    flash('You must be logged in to view that page.')
    return redirect(url_for('login.login'))
