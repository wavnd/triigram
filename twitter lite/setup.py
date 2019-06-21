from setuptools import setup

setup(
    name='TwitterLite',
    version='1.0',
    python_requires='>3.5',
    description='TwitterLite with Neo4j & flask',
    packages=['twitter_lite'],
    install_requires=[

        'Jinja2',
        'py2neo',
        'neo4j',
        'Click',
        'flask',
        'flask-login',
        'flask-mail',
        'MarkupSafe',
        'itsdangerous',
        'neo4j',
        'neobolt==1.7.12',
        'neotime',
        'pytz',
        'six',
        'passlib',
        'werkzeug',
        'wtforms',
        'flask_wtf',
        'blinker',
        'python-dateutil'
    ],
)
