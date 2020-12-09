var Person = require('../models/person.model')



exports.getPersons = async function () {
    try {
        var persons = await Person.find()
        return persons;
    } catch (e) {
        // Log Errors
        throw Error('Error while Paginating Persons')
    }
}


exports.createPerson = async function (data) {
    var person = new Person({
        name: data.name, 
        lastName: data.lastName, 
        dni: data.dni, 
        alias: data.alias, 
        email: data.email, 
        phoneNumber: data.phoneNumber, 
        address: data.address, 
        country: data.country, 
        state: data.state,
        city: data.city
    });
    var upload = await person.save().catch(err => err);
    if(upload.name){
        return {status: 1}
    }else{
        return {status: 0, error: upload}
    }
}

exports.deletePerson = async function (id) {
    try {
        var status = await Person.deleteOne({_id: id}).catch(err => err);
        if(status.n == 1){
            return {status: 1}
        }else{
            return {status: 0}
        }
    } catch (e) {
        // Log Errors
        throw Error('Error while Deleting Person: ' + e)
    }
}


exports.getPersonById = async function (id) {
    try {
        var person = await Person.findOne({_id: id})
        return person;
    } catch (e) {
        // Log Errors
        throw Error('Error while Paginating Person ' + e)
    }
}


exports.updatePerson = async function (data) {
    person = await Person.findOne({_id: data.id});
    person.name = data.name; 
    person.lastName = data.lastName; 
    person.dni = data.dni; 
    person.alias = data.alias; 
    person.email = data.email; 
    person.phoneNumber = data.phoneNumber; 
    person.address = data.address; 
    person.country = data.country; 
    person.state = data.state;
    person.city = data.city;
    var upload = await person.save().catch(err => err);
    if(upload.name){
        return {status: 1}
    }else{
        return {status: 0, error: upload}
    }
}