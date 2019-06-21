class Hashtag:
    """
    Hastag

    This is the hashtag model class

    The data is stored here for use in python and Jinja2

    There should be NO data manipulation done here!
    """
    def __init__(self, tag_name: str) -> None:
        self.tag_name = tag_name
