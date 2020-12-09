var UserService = require('../services/user.services');  

exports.getUsers = async function (req, res, next) {
    // Validate request parameters, queries using express-validator
    var page = req.params.page ? req.params.page : 1;
    var limit = req.params.limit ? req.params.limit : 10;
    try {
        var users = await UserService.getUsers({}, page, limit)
        return res.status(200).json({ status: 200, data: users, message: "Succesfully Users Retrieved" });
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
}

exports.getUserById = async function (req, res, next) {
    // Validate request parameters, queries using express-validator
    var id = req.params.id;
    try {
        var user = await UserService.getUserById(id)
        console.log(user);
        return res.status(200).json({ status: 200, data: user, message: "Succesfully User Retrieved" });
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
    
}

exports.createUser = async function (req, res, next) {
    var data = req.body;
    try {
        var user = await UserService.createUser(data);
        if(user.status == 0){
            return res.status(400).json({ status: 400, data: false, message: user.error });
        }else{
            return res.status(200).json({ status: 200, data: true, message: "Succesfully User Created" });
        }
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
    
}

exports.deleteUser = async function (req, res, next) {
    var data = req.body;
    try {
        var user = await UserService.deleteUser(data.id);
        if(user.status == 0){
            return res.status(400).json({ status: 400, data: false, message: "Can't Delete User" });
        }else{
            return res.status(200).json({ status: 200, data: true, message: "Succesfully User Deleted" });
        }
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
    
}

exports.login = async function (req, res, next) {
    var data = req.body;
    try {
        var user = await UserService.login(data);
        if(user.status == 0){
            return res.status(400).json({ status: 400, data: 0, message: 'Wrong Password' });
        }else if(user.status == 1){
            return res.status(200).json({ status: 200, data: 1, message: "Succesfully Log In" });
        }else{
            return res.status(400).json({ status: 400, data: 2, message: 'Wrong Email' });
        }
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
    
}

exports.updateUser = async function (req, res, next) {
    // Validate request parameters, queries using express-validator
    try {
        var user = await UserService.updateUser(req.body)
        console.log(user);
        return res.status(200).json({ status: 200, data: user, message: "Succesfully Person Updated" });
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
}