var express = require('express');
var router = express.Router();
var User = require('../models/user');
var path = require('path');

router.get('/', function (req, res, next) {
    return res.sendFile(path.join(__dirname + '/../templetes/login.html'));
});
// GET route for register page
router.get('/register', function (req, res, next) {
    return res.sendFile(path.join(__dirname + '/../templetes/register.html'));
    // res.render('templetes/register');
});
//POST route for registration
router.post('/register', function (req, res, next) {
// check whether the user typed matching passwords
    if (req.body.password !== req.body.passwordTwo) {
        var err = new Error('<body style="background-color: #343148FF;">Passwords dont match</body>');
        err.status = 400;
        // this doesn't really execute since we do the checking via javascript on the front-end
        res.send('<body style="background-color: #343148FF;">Passwords dont match</body>');
        return next(err);
    }
            var userData = {
                name: req.body.name,
                surname: req.body.surname,
                email: req.body.email,
                country: req.body.country,
                password: req.body.password,
            }

            User.create(userData, function (error, user) {
                if (error) {
                    return next(error);
                }else{
                    req.session.userId = user._id;
                    return res.send('<body style="background-color: #343148FF;"><div class="row"><h2>You have signed up!</h2><form action="/"><button class="btn btn-secondary" type="submit">Login</button></form></div></body>');
                }
            });
});

//POST route for login data
router.post('/', function (req, res, next) {
        User.authenticate(req.body.email, req.body.password, function (error, user) {
            if (error || !user) {
                var err = new Error('<body style="background-color: #343148FF;"><p>Wrong email or password.</p><form action="/"><button class="btn btn-secondary" type="submit">Login</button></form></body>');
                err.status = 401;
                return next(err);
            }else{
                req.session.userId = user._id;
                return res.send('<body style="background-color: #343148FF;"><div class="row"><h2>You have signed in!</h2><form action="/logout"><button class="btn btn-secondary" type="submit">Logout</button></form></div></body>');
            }
        });
});

// GET for logout logout
router.get('/logout', function (req, res, next) {
    if (req.session) {
        // delete session object
        req.session.destroy(function (err) {
            if (err) {
                return next(err);
            }else{
                return res.redirect('/');
            }
        });
    }
});

module.exports = router;
