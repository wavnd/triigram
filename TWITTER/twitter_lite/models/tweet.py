from datetime import datetime

from twitter_lite.models import Hashtag, User


class Tweet:
    def __init__(self, tweet_uuid: str or None, content: str, created_at: datetime, hashtags: [Hashtag] = None,
                 likes: [User] = None) -> None:
        self.uuid = tweet_uuid
        self.content = content
        self.created_at = created_at
        self.hashtags = hashtags
        self.likes = likes
        self.liked = False
        self.retweeted = False
