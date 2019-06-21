from datetime import datetime

from flask import current_app
from itsdangerous import BadSignature, SignatureExpired
from itsdangerous import TimedJSONWebSignatureSerializer as Serializer


class User(object):

    def __init__(self, username: str, password: str, email: str = None, first_name: str = None, last_name: str = None,
                 date_of_birth: datetime = None, bio: str = None, profile_pic_url: str = None,
                 followers: [] = None) -> None:
        self.username = username
        self.password = password
        self.email = email
        self.first_name = first_name
        self.last_name = last_name
        self.date_of_birth = date_of_birth
        self.bio = bio
        self.profile_pic_url = profile_pic_url
        self.followers = followers
        self.authenticated = False

    @staticmethod
    def is_active():
        """True, as all users are active."""
        return True

    def get_id(self):
        """Return the username to satisfy Flask-Login's requirements."""
        return self.username

    def is_authenticated(self):
        """Return True if the user is authenticated."""
        return self.authenticated

    @staticmethod
    def is_anonymous():
        """False, as anonymous users aren't supported."""
        return False

    def generate_auth_token(self):
        s = Serializer(current_app.config['SECRET_KEY'], expires_in=3600)
        return s.dumps({'username': self.username}).decode('utf-8')

    @staticmethod
    def verify_auth_token(token):
        s = Serializer(current_app.config['SECRET_KEY'])
        try:
            data = s.loads(token)['username']
        except (BadSignature, SignatureExpired, TypeError):
            return 'something is wrong'
        return data
