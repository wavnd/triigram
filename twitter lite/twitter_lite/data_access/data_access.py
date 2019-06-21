from neo4j import GraphDatabase

from twitter_lite.properties import Neo4JProperties


class DataAccessObject:

    def __init__(self):
        self.graph = GraphDatabase.driver(Neo4JProperties.URL, auth=Neo4JProperties.AUTH)
