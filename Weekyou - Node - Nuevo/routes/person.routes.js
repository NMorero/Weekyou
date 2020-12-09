var express = require('express');
var router = express.Router();

var PersonController = require('../controllers/person.controllers');


router.get('/All', PersonController.getPersons);
router.get('/Get/:id', PersonController.getPersonById);
router.post('/Create', PersonController.createPerson);
router.post('/Delete', PersonController.deletePerson);
router.post('/Update', PersonController.updatePerson);

module.exports = router;

