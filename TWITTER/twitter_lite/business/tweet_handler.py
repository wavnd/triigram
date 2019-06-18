import re
import uuid
from datetime import datetime
from typing import List

from twitter_lite.data_access import TweetDAO
from twitter_lite.models import User, Hashtag, Tweet


class TweetHandler:
    def __init__(self):
        self.tweet_dao = TweetDAO()

    def get_tweets_of_followers(self, user: User) -> List[Tweet]:
        followers = self.tweet_dao.get_tweets_of_followers(user)

        for tweet in followers:
            tweet['tweet'][0].liked = self.is_liked_by_user(user, tweet['tweet'][0])
            tweet['tweet'][0].retweeted = self.is_retweeted_by_user(user, tweet['tweet'][0])

        return followers

    def add_new_tweet(self, content: str, user: User) -> None:
        # Extracts the hashtags from the content
        hashtags_text = re.findall(r"(#\w+)", content)
        hashtags = [Hashtag(x) for x in hashtags_text]
        tweet = Tweet(uuid.uuid4().__str__(), content, datetime.now(), hashtags)

        self.tweet_dao.add_new_tweet(tweet, user)

    def is_liked_by_user(self, user: User, tweet: Tweet):
        likes = self.tweet_dao.get_user_who_liked(tweet.uuid)
        return any(user.username == liker.username for liker in likes)

    def re_tweet(self, tweet_uuid: str, user: User) -> None:
        self.tweet_dao.re_tweet(tweet_uuid, user)

    def like_tweet(self, tweet_uuid: str, user: User) -> None:
        self.tweet_dao.like_tweet(tweet_uuid, user)

    def get_total_tweets_by_user(self, username: str):
        self.tweet_dao.get_total_tweets_by_user(username)

    def load_tweets_by_user(self, username: str):
        return self.tweet_dao.get_all_tweets_by_user(username)

    def is_retweeted_by_user(self, user: User, tweet: Tweet):
        retweeters = self.tweet_dao.get_user_who_retweeted(tweet.uuid)
        return any(user.username == retweeter.username for retweeter in retweeters)
