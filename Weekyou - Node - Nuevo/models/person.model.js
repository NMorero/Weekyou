const { ObjectId } = require('mongodb');
var mongoose = require('mongoose')

const PersonSchema  = new mongoose.Schema({
    name: {
        type:String,
        required: true
    }, 
    lastName: {
        type:String,
        required: true
    }, 
    dni: {
        type: Number,
        required: true
    }, 
    alias: {
        type:String,
        required: true
    }, 
    email: {
        type:String,
        required: true
    }, 
    phoneNumber: {
        type: Number,
        required: true
    }, 
    address: {
        type:String,
        required: true
    }, 
    country: {
        type: Number,
        required: true
    }, 
    state: {
        type:String,
        required: true
    }, 
    city: {
        type:String,
        required: true
    }, 
    relationshipId: {
        type: ObjectId,
        required: false
    }
})

const Person = mongoose.model('persons', PersonSchema)

module.exports = Person;