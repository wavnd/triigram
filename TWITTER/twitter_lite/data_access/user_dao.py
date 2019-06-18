from typing import List

from twitter_lite.data_access import DataAccessObject
from twitter_lite.models import User


class UserDAO(DataAccessObject):

    def does_user_exist(self, username) -> bool:
        with self.graph.session() as session:
            query = "MATCH (user: User) RETURN user"
            results = session.run(query)

        for i in results:

            if i[0]["Username"] == username:
                return True
        return False

    def register_user(self, user: User) -> None:
        with self.graph.session() as session:
            query = "CREATE (user:User {Username: {username}, Password: {password}, Email: {email}, " \
                    "FirstName: {first_name}, LastName: {last_name}, DateOfBirth: {date_of_birth}, Bio: {bio}, " \
                    "ProfilePicUrl: {profile_pic_url}})"
            session.run(query, username=user.username, password=user.password, email=user.email,
                        first_name=user.first_name, last_name=user.last_name,
                        date_of_birth=user.date_of_birth,
                        bio=user.bio, profile_pic_url=user.profile_pic_url)

    def get_user(self, username: str) -> User:
        with self.graph.session() as session:
            query = "MATCH (user: User) WHERE user.Username = '" + username + "' RETURN user"
            results = session.run(query)

        for result in results:
            temp = self.get_user_from_result(result[0])

            return temp

    def get_recomondation_for_followers(self, user: User) -> [User]:
        # TODO Make this!!!!!!
        print("Getting recomendations for " + user.username)
        return UserDAO.users

    def update_my_info(self, user: User):
        with self.graph.session() as session:
            query = "MATCH (n:User) WHERE n.Username = '" + user.username + \
                    "'SET n.Bio = '" + user.bio + \
                    "' , n.ProfilePicUrl = '" + user.profile_pic_url + "' " \
                                                                       "RETURN n.Bio, n.ProfilePicUrl"

            session.run(query)

    def follow_user(self, u_name1: str, u_name2: str):
        with self.graph.session() as session:
            query = "MATCH (u1:User), (u2:User)" \
                    "WHERE u1.Username={username1} AND u2.Username={username2}" \
                    "MERGE (u1)-[f:FOLLOWS]->(u2)"
            session.run(query, username1=u_name1, username2=u_name2)

    def unfollow_user(self, u_name1: str, u_name2: str):
        with self.graph.session() as session:
            query = "MATCH (u1:User {Username: {username1}})-[f:FOLLOWS]->(u2:User {Username: {username2}})" \
                    "DELETE f"
            print(u_name1, "fck -> ", u_name2)
            session.run(query, username1=u_name1, username2=u_name2)

    def update_password(self, user: User):
        with self.graph.session() as session:
            query = "MATCH (n:User) WHERE n.Username = {username} " \
                    "SET n.Password = {password}"

            session.run(query, username=user.username, password=user.password)

    def get_followers(self, username: str) -> List[User]:
        with self.graph.session() as session:
            query = "MATCH (follower: User)-[FOLLOWS]->(user:User {Username: {username}}) RETURN follower"
            results = session.run(query, username=username)

        followers = []
        for result in results:
            followers.append(self.get_user_from_result(result[0]))

        return followers

    @staticmethod
    def get_user_from_result(result):
        return User(result["Username"], result["Password"], result["Email"], result["FirstName"],
                    result["LastName"], result["DateOfBirth"], result["Bio"], result["ProfilePicUrl"])
