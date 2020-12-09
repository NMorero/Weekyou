var bcrypt = require('bcrypt');
var User = require('../models/user.model')

exports.getUsers = async function (query, page, limit) {
    try {
        var users = await User.find();
        return users;
    } catch (e) {
        // Log Errors
        throw Error('Error while Paginating Users')
    }
}

exports.getUserById = async function (id) {
    try {
        var users = await User.findOne({_id: id});
        return users;
    } catch (e) {
        // Log Errors
        throw Error('Error while Paginating Users ' + e)
    }
}

exports.createUser =  async function (data) {
    var exist = await User.exists({email: data.email});
    if (exist) {
        return {status: 0, error: 'Email already exist'};
    } else {
        var passwordHash = await bcrypt.hash(data.password, 12);
        if (data.person) {
            var user =  new User({
                username: data.username, 
                email: data.email, 
                password: passwordHash, 
                emailVerified: false,
                person: data.person
            })
        } else {
            var user =  new User({
                username: data.username, 
                email: data.email, 
                password: passwordHash, 
                emailVerified: false
            })
        }
        var upload = await user.save().catch(err => err);
        console.log(upload);
        if (upload.username) {
            return {status: 1};
        } else {
            console.log(upload);
            return {status: 0, error: upload};
        }
    }
}

exports.deleteUser = async function (id) {
    try {
        var status = await User.deleteOne({_id: id}).catch(err => err);
        if (status.n == 1) {
            return {status: 1}
        } else {
            return {status: 0}
        }
    } catch (e) {
        // Log Errors
        throw Error('Error while Deleting Users ' + e)
    }
}


exports.login = async function (data) {
    try {
        var exist = await User.exists({email: data.email});
        if (exist) {
            var user = await User.findOne({email: data.email});
            var verify = await bcrypt.compare(data.password, user.password);
            if (verify) {
                return {status: 1}
            } else {
                return {status: 0}
            }
        } else {
            return {status: 2}
        }
    } catch (e) {
        // Log Errors
        throw Error('Error while Login User ' + e)
    }
}

exports.updateUser = async function (data) {
    user = await User.findOne({_id: data.id});
    user.username = data.username; 
    user.email = data.email; 
    user.emailVerified = false;
    if (data.person) {
        user.person = data.person;
    }
    var upload = await user.save().catch(err => err);
    if (upload.name) {
        return {status: 1}
    } else {
        return {status: 0, error: upload}
    }
}