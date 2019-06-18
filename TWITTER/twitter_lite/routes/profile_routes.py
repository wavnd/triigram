from flask import render_template, Blueprint, redirect, url_for, flash
from flask_login import current_user, login_required
import binascii
import os
from twitter_lite import login_manager
from twitter_lite.business import TweetHandler, HashTagHandler, UserHandler
from twitter_lite.forms import UpdateProfileForm, searchBar, change_password
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
profile_routes = Blueprint('profile', __name__, template_folder='../templates')

# The creation of the used business classes
tweetHandler = TweetHandler()
hashTagHandler = HashTagHandler()
userHandler = UserHandler()


# See we're using home_routes as a variable here. That is so it can communicate with the flask app once it is registered
# in the `create_app()` function
@profile_routes.route('/profile')
@login_required
def profile():
    # Checks if there is currently a user logged in for a session
    if current_user.is_authenticated:
        # Send data to the template file `profile.html`
        # Default image will change to current_user.image_url
        image_file = url_for('static', filename='images/' + 'default.jpg')
        form = searchBar()
        my_tweet = tweetHandler.load_tweets_by_user(current_user.username)
        return render_template('profile.html', logged_in=True, user=current_user, image_file=image_file,
                               tweets=my_tweet, form=form)
    else:
        return render_template('index.html', logged_in=False)


def save_pic(picture):
    new_random_file_name = binascii.hexlify(os.urandom(8)).decode()
    _, file_type = os.path.splitext(picture.filename)
    new_file_name = new_random_file_name + file_type
    picture.save('twitter_lite/static/images/' + new_file_name)
    return secure_filename(new_file_name)


@profile_routes.route('/update_profile', methods=['GET', 'POST'])
@login_required
def update_profile():
    # Checks if there is currently a user logged in for a session
    if current_user.is_authenticated:
        form = UpdateProfileForm()
        if form.validate_on_submit():
            # use the form data to update database data
            print("form validated")

            if form.picture.data is not None:
                print("pic has been chosen")
                picture_file = save_pic(form.picture.data)
                print(picture_file + " pic name i guess ")
                current_user.bio = form.bio.data
                current_user.profile_pic_url = picture_file
                current_user.username = form.username.data
                current_user.email = form.email.data
                userHandler.update_profile(current_user.username, current_user.password, current_user.email,
                                           current_user.first_name, current_user.last_name, current_user.date_of_birth,
                                           current_user.bio, current_user.profile_pic_url)
                print("data sent")
                print("bio is " + current_user.bio)
                # use new url to upload to database
            flash("Profile updated", 'success')
            return redirect(url_for('profile.profile'))
        else:
            form.username.data = current_user.username
            form.email.data = current_user.email
            form.bio.data = current_user.bio

        image_file = url_for('static', filename='images/' + current_user.profile_pic_url)
        return render_template('update_profile.html', logged_in=True, user=current_user, image_file=image_file,
                               form=form)
    else:
        return render_template('index.html', logged_in=False)


@profile_routes.route('/update_password', methods=['GET', 'POST'])
@login_required
def update_password():
    if current_user.is_authenticated:
        form = change_password()
        if form.validate_on_submit():
            if userHandler.verify_password(current_user.username, form.current_password.data) is not None:
                current_user.password = form.password.data
                userHandler.update_password(current_user.username, current_user.password, current_user.email,
                                            current_user.first_name, current_user.last_name, current_user.date_of_birth,
                                            current_user.bio, current_user.profile_pic_url)
                flash("Password updated", 'success')
                return redirect(url_for('profile.profile'))
            else:
                flash("Password not updated", 'success')

        return render_template('update_password.html', logged_in=True, user=current_user, form=form)


# A default endpoint for unauthorized requests
@login_manager.unauthorized_handler
def unauthorized():
    """Redirect unauthorized users to Login page."""
    flash('You must be logged in to view that page.')
    return redirect(url_for('login.login'))
