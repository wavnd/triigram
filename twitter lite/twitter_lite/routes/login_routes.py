from datetime import datetime

from flask import request, flash, session, redirect, url_for, render_template, Blueprint
from flask_login import login_user, logout_user, current_user

from twitter_lite.business import UserHandler
from twitter_lite.forms import LoginForm, resetPassword, newPassword
from twitter_lite.models import User
from flask_mail import Message
from twitter_lite import mail, token_secret
from itsdangerous import TimedJSONWebSignatureSerializer as Serializer

login_routes = Blueprint('login', __name__, template_folder='../templates')

userHandler = UserHandler()


@login_routes.route('/login', methods=['GET', 'POST'])
def login():
    # If you're already logged in redirect to the home page
    if current_user.is_authenticated:
        flash("You're already logged in")
        return redirect(url_for('home.index'))

    login_form = LoginForm()
    # If validated correctly
    if login_form.validate_on_submit():
        username = login_form.username.data
        password = login_form.password.data
        remember_me = login_form.remember.data

        user = userHandler.verify_password(username, password)
        if not user:
            # Password does not match
            # TODO Add a warning to retry
            flash('Invalid login.')
        else:
            usr = userHandler.get_user(username)
            login_user(usr, remember=remember_me)
            next_page = request.args.get('next')
            flash('Logged in.')

            return redirect(next_page) if next_page else redirect(url_for('home.index'))

    return render_template('login.html', form=login_form)


@login_routes.route('/logout')
def logout():
    logout_user()
    flash('Logged out.')
    return redirect(url_for('home.index'))


@login_routes.route('/reset_password', methods=['GET', 'POST'])
def reset():
    form = resetPassword()
    if form.validate_on_submit():
        temp_user = userHandler.get_user(form.username.data)
        send_email(temp_user)
        flash('Email Sent', 'succes')
        return redirect(url_for('login.login'))
    return render_template('reset_password.html', title='Reset Password', form=form)


@login_routes.route('/new_password/<token>', methods=['GET', 'POST'])
def new_password(token: str):
    if current_user.is_authenticated:
        flash("You're already logged in")
        return redirect(url_for('home.index'))
    user = userHandler.get_user(User.verify_auth_token(token))
    if user is None:
        flash('Invalid or expiered token', 'warning')
        return redirect(url_for('login.login'))
    form = newPassword()
    if form.validate_on_submit():
        userHandler.update_password(user.username, form.password.data, user.email,
                                    user.first_name, user.last_name, user.date_of_birth,
                                    user.bio, user.profile_pic_url)
        return redirect(url_for('login.login'))
    return render_template('new_password.html', title='Reset Password', form=form)


'''

 THIS IS IMPORTANT
 You have to use pip install flask-mail to make this work
'''


def send_email(user):
    token = user.generate_auth_token()
    url = 'http://localhost:5000/new_password/' + token
    msg = Message('Password Reset',
                  sender='twitterlite2019@gmail.com',
                  recipients=[user.email])
    msg.body = ''' To reset your password, visit the following link: %s

If you did not make this request just ignore this mal

    ''' % url
    mail.send(msg)
