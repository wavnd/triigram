import re
from typing import List

from passlib.hash import sha256_crypt

from twitter_lite import login_manager
from twitter_lite.data_access import UserDAO
from twitter_lite.models import User


class UserHandler:

    def __init__(self):
        self.user_data_access = UserDAO()

    def register(self, username, password, email, first_name, last_name, date_of_birth, bio, profile_pic_url):
        password = UserHandler.encrypt_password(password)
        new_user = User(username, password, email, first_name, last_name, date_of_birth, bio,
                        profile_pic_url)
        if not self.user_data_access.does_user_exist(new_user.username):
            self.user_data_access.register_user(new_user)
            return True
        else:

            return False

    @staticmethod
    def form_validation(first_name, last_name, email, password, date_of_birth):
        reg_password = r"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!#%*?&]{6,20}$"
        reg_first_name = r"/^[A-Za-z ]+$/"
        reg_last_name = r"/^[A-Za-z ]+$/"
        reg_dob = r"^\d\d\d\d/(0?[1-9]|1[0-2])/(0?[1-9]|[12][0-9]|3[01])"
        reg_email = r"/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/"

        pat_pass = re.compile(reg_password)
        pat_f_name = re.compile(reg_first_name)
        pat_l_name = re.compile(reg_last_name)
        pat_dob = re.compile(reg_dob)
        pat_email = re.compile(reg_email)

        mat1 = re.search(pat_pass, password)
        mat2 = re.search(pat_f_name, first_name)
        mat3 = re.search(pat_l_name, last_name)
        mat4 = re.search(pat_dob, date_of_birth)
        mat5 = re.search(pat_email, email)

        if None in (mat1, mat2, mat3, mat4, mat5):
            return False
        else:
            return True

    @staticmethod
    def encrypt_password(passw: str):
        password_new = sha256_crypt.encrypt((str(passw)))
        return password_new

    def verify_password(self, username: str, password: str) -> User or None:
        """Get user from user dao and check if password matches

        :return User if true else return None
        """
        if self.user_data_access.does_user_exist(username):
            user = self.user_data_access.get_user(username)
            if sha256_crypt.verify(password, user.password):
                return user
            else:
                return None
        else:
            return None

    @staticmethod
    @login_manager.user_loader
    def get_user(username: str) -> [User]:
        """Given *user_id*, return the associated User object.

        :param unicode username: user_id (email) user to retrieve

        """
        user = UserDAO().get_user(username)
        user.followers = UserDAO().get_followers(username)
        return user

    def get_recommendations_for_followers(self, user: User) -> List[User]:
        return self.user_data_access.get_recomondation_for_followers(user)

    def update_profile(self, new_username, new_pass, new_email, new_f, new_l, new_dob, new_bio, new_pic):
        current = User(new_username, new_pass, new_email, new_f, new_l, new_dob, new_bio, new_pic)
        self.user_data_access.update_my_info(current)

    def get_token(self, username):
        return UserDAO().get_reset_token(username)

    def vertify_token(token):
        return UserDAO().verify_reset_token(token)

    def update_password(self, new_username, new_pass, new_email, new_f, new_l, new_dob, new_bio, new_pic):
        password = UserHandler.encrypt_password(new_pass)
        current = User(new_username, password, new_email, new_f, new_l, new_dob, new_bio, new_pic)
        self.user_data_access.update_password(current)

    def follow_user(self, current_user: User, to_be_followed_user: str):
        self.user_data_access.follow_user(current_user.username, to_be_followed_user)

    def unfollow_user(self, current_user, username:str):
        self.user_data_access.unfollow_user(current_user.username, username)

    def is_followed_by_user(self, current_user: User, next_user: User):
        followers = self.user_data_access.get_followers(next_user.username)
        return any(x.username == current_user.username for x in followers)
    def does_user_exist(self, username):

        return UserDAO().does_user_exist(username)
