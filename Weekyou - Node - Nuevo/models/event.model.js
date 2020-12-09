const { ObjectId } = require('mongodb');
var mongoose = require('mongoose');


const EventSchema  = new mongoose.Schema({
    content: {
        type: String,
        required: true
    }, 
    date: {
        type: Date,
        required: true
    }, 
    userId: {
        type: ObjectId,
        required: true
    }, 
    clientRepresentativeId: {
        type: String,
        required: true
    }, 
    projectId: {
        type: ObjectId,
        required: true
    },
})

const Event = mongoose.model('events', EventSchema)


module.exports = Event;