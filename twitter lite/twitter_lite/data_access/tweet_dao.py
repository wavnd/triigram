import re

import dateutil.parser

from twitter_lite.data_access import DataAccessObject
from twitter_lite.models import Tweet, User


class TweetDAO(DataAccessObject):

    def add_new_tweet(self, tweet: Tweet, user: User) -> None:
        with self.graph.session() as session:
            query = "CREATE(tweet:Tweet {UUID: {uuid}, Content: {content}, CreatedAt: {created_at}})"
            session.run(query, uuid=tweet.uuid, content=tweet.content,
                        created_at=tweet.created_at.isoformat())

            for i in tweet.hashtags:
                query2 = "MERGE(tag:Hashtag {Name: {tag_name}})"
                session.run(query2, tag_name=i.tag_name)
                query3 = "MATCH (tweet:Tweet {UUID: {uuid}}), (tag:Hashtag {Name: {tag_name}}) " \
                         "MERGE (tweet)-[:TAGGED]->(tag)"
                session.run(query3, tag_name=i.tag_name, uuid=tweet.uuid)

            query4 = "MATCH (user:User {Username: {username}} ), (tweet:Tweet {UUID: {uuid}}) " \
                     "MERGE (user)-[:TWEETED]->(tweet)"
            session.run(query4, username=user.username, uuid=tweet.uuid)

    def get_tweets_of_followers(self, user: User) -> {User, Tweet}:
        with self.graph.session() as session:
            query = "MATCH (user: User {Username: {username}})-[FOLLOWS]->(other_user:User)-[:TWEETED]->(tweet:Tweet)" \
                    " RETURN other_user, tweet" \
                    " ORDER BY tweet.CreatedAt DESC"
            results = session.run(query, username=user.username)
        t = []
        for record in results:
            t.append(
                {'user': [self.get_user_from_result(record[0])],
                 'tweet': [self.create_tweet_from_record(record[1], self.get_user_who_liked(record[1]["UUID"]))]})

        return t

    def re_tweet(self, tweet_uuid: str, user: User) -> None:
        with self.graph.session() as session:
            query = "MATCH (user:User {Username: {username}}), (tweet:Tweet {UUID: {uuid}})" \
                    "MERGE (user)-[:RETWEET]->(tweet)"
            session.run(query, username=user.username, uuid=tweet_uuid)

    def like_tweet(self, tweet_uuid: str, user: User) -> None:
        with self.graph.session() as session:
            query = "MATCH (user:User {Username: {username}}), (tweet:Tweet {UUID: {uuid}})" \
                    "MERGE (user)-[:LIKED]->(tweet)"
            session.run(query, username=user.username, uuid=tweet_uuid)

    def get_total_tweets_by_user(self, username: str):
        pass

    def get_all_tweets_by_user(self, username: str) -> [Tweet]:
        with self.graph.session() as session:
            query = "MATCH (n:User)-[:TWEETED]->(tweet:Tweet) WHERE n.Username = {username} " \
                    "RETURN tweet " \
                    "ORDER BY tweet.CreatedAt DESC"
            results = session.run(query, username=username)
        t = []
        for tweets in results:
            t.append(self.create_tweet_from_record(tweets[0], self.get_user_who_liked(tweets[0]["UUID"])))

        return t

    @staticmethod
    def create_tweet_from_record(record, likes: [User]):
        return Tweet(record["UUID"],
                     re.sub(r'(?<!\S)#([0-9a-zA-Z-_]+)', r'<a href="/hashtags_search?tag_name=\1">#\1</a>',
                            record["Content"]), dateutil.parser.parse(record["CreatedAt"]), [], likes)

    @staticmethod
    def get_user_from_result(result):
        return User(result["Username"], result["Password"], result["Email"], result["FirstName"],
                    result["LastName"], result["DateOfBirth"],
                    result["Bio"], result["ProfilePicUrl"])

    def get_user_who_liked(self, uuid):
        with self.graph.session() as session:
            query = "MATCH (n:User)-[:LIKED]->(tweet:Tweet) WHERE tweet.UUID = {uuid} " \
                    "RETURN n "
            results = session.run(query, uuid=uuid)
        t = []
        for users in results:
            t.append(self.get_user_from_result(users[0]))

        return t

    def get_user_who_retweeted(self, uuid):
        with self.graph.session() as session:
            query = "MATCH (n:User)-[:RETWEET]->(tweet:Tweet) WHERE tweet.UUID = {uuid} " \
                    "RETURN n "
            results = session.run(query, uuid=uuid)
        t = []
        for users in results:
            t.append(self.get_user_from_result(users[0]))

        return t
