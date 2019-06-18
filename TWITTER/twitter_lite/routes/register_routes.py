from flask import request, flash, session, redirect, url_for, render_template, Blueprint
from flask_login import current_user

from twitter_lite.business import UserHandler
from twitter_lite.forms import RegistrationForm
import binascii
import os

register_routes = Blueprint('register', __name__, template_folder='../templates')

userHandler = UserHandler()


@register_routes.route('/register', methods=['GET', 'POST'])
# The flask_wtf has a built in validator that can be found in forms.py
# This can also be used in the login system
def register():
    # If you're already logged in redirect to the home page
    if current_user.is_authenticated:
        flash("You're already logged in")
        return redirect(url_for('home.index'))

    form = RegistrationForm()
    if form.validate_on_submit():

        if form.profile_url.data:
            picture_file = save_pic(form.profile_url.data)
        else:
            picture_file = 'default.jpg'

        if not userHandler.register(form.username.data, form.password.data, form.email.data, form.firstname.data,
                                    form.lastname.data, form.dateOfBirth.data, form.bio.data, picture_file):
            flash('Registration issue, username taken', 'error')

        else:
            flash('Your account has been created. You may now login.', 'success')
            return redirect(url_for('login.login'))

    return render_template('register.html', title='Register', form=form)


def save_pic(picture):
    new_random_file_name = binascii.hexlify(os.urandom(8)).decode()
    _, file_type = os.path.splitext(picture.filename)
    new_file_name = new_random_file_name + file_type
    picture.save('twitter_lite/static/images/' + new_file_name)
    return new_file_name
