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
                age: 0,
                university: req.body.university,
                faculty: req.body.faculty,
                fcourse: " ",
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

router.post('/', function (req, res, next) {
//POST route for login data
        User.authenticate(req.body.email, req.body.password, function (error, user) {
            if (error || !user) {
                var err = new Error('<body style="background-color: #343148FF;"><p>Wrong email or password.</p><form action="/"><button class="btn btn-secondary" type="submit">Login</button></form></body>');
                err.status = 401;
                return next(err);
            }else{
                req.session.userId = user._id;
                // return res.send('<body style="background-color: #343148FF;"><div class="row"><h2>You have signed in!</h2><form action="/logout"><button class="btn btn-secondary" type="submit">Logout</button></form></div></body>');
                // return res.redirect("/profile");
                // console.log(user);
                // 
                return res.sendFile(path.join(__dirname + '/../templetes/profile.html'));
            }
        });
});
// GET for the user profile page
router.get('/user', function (req, res, next) {
    User.findById(req.session.userId)
        .exec(function (error, user) {
            if (error) {
                return next(error);
            } else {
                if (user === null) {
                    var err = new Error('Not authorized! Go back!');
                    err.status = 400;
                    return next(err);
                } else {
                    return res.send(user);                }
            }
        });
});
// router.get('/profile', function (req, res, next) {
    
           
// });
// router.get('/ajaxURL', function (req, res) {
//     var user = User.findOne({ email: email.value });
    
    
//     res.send(user);
// });

router.post("/user", function(req, res, next){

    console.log('inside the put');
    
    console.log(req.session.userId+" this id");
    console.log(req.body.fcourse+" is the fav course");
    
    User.findByIdAndUpdate({ _id: req.session.userId}, req.body).then(function(){
        console.log("updated");
    
        User.findOne({ _id: req.session.userId}).then(function(user){
            // console.log(user);
            return res.send('<body style="background-color: #00203FFF;"><div class="row"><h2>Updated successfully!</h2><form action="/"><button class="btn btn-secondary" type="submit">Login</button></form></div></body>');
        });

    });
})

// GET for logout
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
