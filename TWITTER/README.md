# The best twitter lite site<sub><sub><sub><sub> that rimes</sub></sub></sub></sub>


Soooo Sean asked me to explain some of the code in the git because it's kind of hard to read

I totally agree with him about this so in this file/ commit I will add some clarifications! :)

___

1. Use python 3.5.2+
1. Don't forget to ALWAYS do `$ git pull`!
1. Make an env if you don't have one
2. Open your env. [Instructions](https://packaging.python.org/guides/installing-using-pip-and-virtual-environments/)
1. Run `$ python setup.py install` 
1. To run the app `$ flask run`
1. Have fun!
2. If there are any modules missing pleas run the command at "1. II."

All project dependencies are listed in the setup.py file. That means if you add a project dependency 
YOU NEED TO ADD IT to that list!

___
## Code structure
All project files should go in the `twitter_lite` folder

### File structure

 * [create_app.py](./twitter_lite/create_app.py) This is were the server executable is created
 * [neo4jExample.py](./twitter_lite/neo4jExample.py) Should/will be removed soon
 * [properties.py](./twitter_lite/properties.py) Neo4j properties should be stored here
 * [db.py](./twitter_lite/db.py) Example db file should be split up and moved in the corresponding data_access files   
 * [password_strength_checker.py](./twitter_lite/password_strength_checker.py) Should be moved to the business file user_handler 
 * [forms.py](./twitter_lite/forms.py) Should be moved to some appropriate location like business
 * [business](./twitter_lite/business) 
   * [user_handler.py](./twitter_lite/business/user_handler.py)
   * [hashTag_handler.py](./twitter_lite/business/hashTag_handler.py)
   * [tweet_handler.py](./twitter_lite/business/tweet_handler.py)
 * [data_access](./twitter_lite/data_access)
   * [data_access.py](./twitter_lite/data_access/data_access.py)
   * [user_dao.py](./twitter_lite/data_access/user_dao.py)
   * [hash_tag_dao.py](./twitter_lite/data_access/hash_tag_dao.py)
   * [tweet_dao.py](./twitter_lite/data_access/tweet_dao.py)
 * [models](./twitter_lite/models)
   * [tweet.pyc](./twitter_lite/models/tweet.pyc)
   * [hashtag.py](./twitter_lite/models/hashtag.py)
   * [user.py](./twitter_lite/models/user.py)
   * [tweet.py](./twitter_lite/models/tweet.py)
 * [routes](./twitter_lite/routes)
   * [error_routes.py](./twitter_lite/routes/error_routes.py)
   * [register_routes.py](./twitter_lite/routes/register_routes.py)
   * [login_routes.py](./twitter_lite/routes/login_routes.py)
   * [home_routes.py](./twitter_lite/routes/home_routes.py)
   * [tweet_routes.py](./twitter_lite/routes/tweet_routes.py)
 * [static](./twitter_lite/static)
   * [style.css](./twitter_lite/static/style.css)
   * [main.css](./twitter_lite/static/main.css)
   * [ajaxcalls.js](./twitter_lite/static/ajaxcalls.js)
 * [templates](./twitter_lite/templates)
     * [error.html](./twitter_lite/templates/error.html)
     * [profile.html](./twitter_lite/templates/profile.html)
     * [create_tweet.html](./twitter_lite/templates/create_tweet.html)
     * [login.html](twitter_lite/templates/login.html)
     * [register.html](./twitter_lite/templates/register.html)
     * [layout.html](./twitter_lite/templates/layout.html)
     * [index.html](./twitter_lite/templates/index.html)

<b> Explanation </b>

* Business:
    * Contains all files for changing/adding/deleting data. It's the pass through for the frontend and database files
* Data_access: 
    * Contains all files for communication with the database. It's executed ONLY by the business files
* Models:
    * The object that contain data. They're the way to pass data to all the different software layers.
* Routes
    * All front end urls are made here. The files are separated by subject.
  
___
While typing this I realize making this documentation is a lot of work. So i'm going to speed up a little :)

<b>Check out all the different files I will add a description to every first file in a folder to explain the general idea!</b>