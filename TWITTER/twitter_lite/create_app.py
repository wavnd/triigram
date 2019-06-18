import os
from flask import Flask
from flask_login import LoginManager
from flask_mail import Mail, Message

login_manager = LoginManager()

app = Flask(__name__, instance_relative_config=False)

# Initialize Mail
app.config['MAIL_SERVER'] = 'smtp.googlemail.com'
app.config['MAIL_PORT'] = 465
app.config['MAIL_USERNAME'] = 'twitterlite2019@gmail.com'
app.config['MAIL_PASSWORD'] = 'CS3342019'
app.config['MAIL_USE_TLS'] = False
app.config['MAIL_USE_SSL'] = True

mail = Mail(app)

token_secret = app.config['SECRET_KEY']


def create_app():
    """Construct the core application."""

    # TODO Remove in production
    app.debug = True

    # Application Configuration
    app.secret_key = os.urandom(24)

    # Initialize Plugins
    login_manager.init_app(app)
    login_manager.login_view = 'login'
    login_manager.login_message_category = 'info'

    with app.app_context():
        # Import all the routes
        from twitter_lite.routes import login_routes, register_routes, home_routes, error_routes, tweet_routes, \
            profile_routes, user_route, hashtag_routes, search_routes
        app.register_blueprint(home_routes)
        app.register_blueprint(login_routes)
        app.register_blueprint(register_routes)
        app.register_blueprint(error_routes)
        app.register_blueprint(tweet_routes)
        app.register_blueprint(profile_routes)
        app.register_blueprint(user_route)
        app.register_blueprint(hashtag_routes)
        app.register_blueprint(search_routes)

        # If you add a route you need to add it here!

        return app
