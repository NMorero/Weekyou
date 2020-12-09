var express = require('express');
var router = express.Router();

var UserController = require('../controllers/user.controllers');

router.get('/All', UserController.getUsers);
router.get('/Get/:id', UserController.getUserById);
router.post('/Create', UserController.createUser);
router.post('/Delete', UserController.deleteUser);
router.post('/Login', UserController.login);
router.post('/Update', UserController.updateUser);

module.exports = router;