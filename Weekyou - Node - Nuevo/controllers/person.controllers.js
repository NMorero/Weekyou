const Person = require('../models/person.model');
var PersonService = require('../services/person.services');  


exports.getPersons = async function (req, res, next) {
    try {
        var persons = await PersonService.getPersons();
        return res.status(200).json({ status: 200, data: persons, message: "Succesfully Persons Retrieved" });
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
}


exports.createPerson = async function (req, res, next) {
    try {
        var person = await PersonService.createPerson(req.body);
        if(person.status == 1){
            return res.status(200).json({ status: 200, data: person, message: "Succesfully Persons Retrieved" });
        }else{
            return res.status(400).json({ status: 400, data: false, message: "Error: " + person.error });
        }
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
}

exports.deletePerson = async function (req, res, next) {
    var data = req.body;
    try {
        var person = await PersonService.deletePerson(data.id);
        if(person.status == 0){
            return res.status(400).json({ status: 400, data: false, message: "Can't Delete Person" });
        }else{
            return res.status(200).json({ status: 200, data: true, message: "Succesfully Person Deleted" });
        }
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
    
}

exports.getPersonById = async function (req, res, next) {
    // Validate request parameters, queries using express-validator
    var id = req.params.id;
    try {
        var person = await PersonService.getPersonById(id)
        console.log(person);
        return res.status(200).json({ status: 200, data: person, message: "Succesfully Person Retrieved" });
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
    
}

exports.updatePerson = async function (req, res, next) {
    // Validate request parameters, queries using express-validator
    try {
        var person = await PersonService.updatePerson(req.body)
        console.log(person);
        return res.status(200).json({ status: 200, data: person, message: "Succesfully Person Updated" });
    } catch (e) {
        return res.status(400).json({ status: 400, message: e.message });
    }
}