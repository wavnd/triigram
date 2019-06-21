from twitter_lite.data_access import HastagDAO
from twitter_lite.models import Hashtag


class HashTagHandler:
    """
    HashTagHandler

    This method is called by a routes file.
    It communicates with the database and manipulates the incoming data if necessary.
    Check out Tweet_handler for a proper example

    By adding this separation you make it easier to add any change necessary without breaking the code (that bad)
    """

    def __init__(self):
        """
        Here in the "contructor" we create the `HashtagDAO` data access object to use later to communicate with the database
        """
        self.tweet_dao = HastagDAO()

    def get_top5_hash_tags(self) -> [Hashtag]:
        return self.tweet_dao.get_top5_hash_tags()

    def get_tweets_by_tag(self, tag_name):
        print("inside hashTag_handler----tag_name= " + tag_name)
        return self.tweet_dao.get_tweets_by_hashtag(tag_name)
