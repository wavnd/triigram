import re

import dateutil

from twitter_lite.data_access import DataAccessObject
from twitter_lite.models import User, Tweet, Hashtag


class HastagDAO(DataAccessObject):
    """
    HastagDAO

    This method is called ONLY by the business classes if necessary to communicate with the database

    There should be NO data manipulation done. Only CRUD operations. Passing the data to appropriate the handler to
    change the data and pass it back here to update the database

    Check out tweet_dao for some working examples

    """

    def get_top5_hash_tags(self):
        with self.graph.session() as session:
            query = "MATCH (h:Hashtag)<-[:TAGGED]-(t:Tweet)<-[:TWEETED]-(u:User) " \
                    "WITH h, COUNT(h) AS Hashtags ORDER BY Hashtags DESC LIMIT 5 RETURN  h"
            results = session.run(query)
            t = []
            for record in results:
                t.append(Hashtag(re.sub(r'(?<!\S)#([0-9a-zA-Z-_]+)', r'<a href="/hashtags_search?tag_name=\1">#\1</a>',
                                        record[0]["Name"])))
            return t

    def get_tweets_by_hashtag(self, tagname):
        with self.graph.session() as session:
            query = "MATCH (user:User)-[:TWEETED]->(tweet:Tweet)-[:TAGGED]->(tag:Hashtag) WHERE tag.Name = '#" + \
                    tagname + "' RETURN user, tweet"
            results = session.run(query, tagname=tagname)
        x = 0
        t = []
        for record in results:
            x = x + 1

            t.append([[self.get_user_from_result(record[0])],
                      [self.create_tweet_from_record(record[1])]])
        return t

    @staticmethod
    def create_tweet_from_record(record):
        return Tweet(record["UUID"], re.sub(r'(?<!\S)#([0-9a-zA-Z-_]+)', r'<a href="/hashtags_search?tag_name=\1">#\1</a>',
                                        record["Content"]), dateutil.parser.parse(record["CreatedAt"]))

    @staticmethod
    def get_user_from_result(result):
        return User(result["Username"], result["Password"], result["Email"], result["FirstName"],
                    result["LastName"], dateutil.parser.parse(result["DateOfBirth"]),
                    result["Bio"], result["ProfilePicUrl"])
