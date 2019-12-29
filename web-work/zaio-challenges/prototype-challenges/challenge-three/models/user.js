var mongoose = require('mongoose');
var bcrypt = require('bcrypt');

var UserSchema = new mongoose.Schema({
    // create schema for the local DB
    name: {
        type: String,
        required: true,
        trim: true
    },
    surname: {
        type: String,
        required: true,
        trim: true
    },
    email: {
        type: String,
        unique: true,
        required: true,
        trim: true
    },
    age: {
        type: Number,
        required: true,
    },
    university: {
        type: String,
        required: true,
    },
    faculty: {
        type: String,
        required: true,
    },
    fcourse: {
        type: String,
        required: true,
    },
    password: {
        type: String,
        required: true,
  }
});

UserSchema.statics.authenticate = function (email, password, callback) {
    User.findOne({ email: email }).exec(function (err, user) {
        if (err) {
            return callback(err)
        }else if (!user) {
            var err = new Error('User does not exist');
            err.status = 401;
            return callback(err);
        }
        bcrypt.compare(password, user.password, function (err, result) {
            if (result === true) {
                return callback(null, user);
            }else{
                return callback();
            }
        })
    });
}

// hash the password using mongoose method
UserSchema.pre('save', function (next) {
    var user = this;
    bcrypt.hash(user.password, 10, function (err, hash) {
        if (err) {
            return next(err);
        }
        user.password = hash;
        next();
    })
});

var User = mongoose.model('User', UserSchema);

module.exports = User;
