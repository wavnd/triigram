from flask import Blueprint, render_template

"""
Error routes

This file is to empty for a proper example. Check out home_routes for a better example
"""

error_routes = Blueprint('error_routes', __name__, template_folder='../templates')


@error_routes.errorhandler(404)
def page_not_found():
    return render_template("error.html")
