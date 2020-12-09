const { ObjectId } = require('mongodb');
var mongoose = require('mongoose');


const ProjectSchema  = new mongoose.Schema({
    name: {
        type: String,
        required: true
    }, 
    deliveryDate: {
        type: Date,
        required: false
    }, 
    status: {
        type: Number,
        required: true
    }, 
    alias: {
        type: String,
        required: true
    }, 
    thumbnail: {
        type: String,
        required: true
    }, 
    client: {
        type: ObjectId,
        required: true
    },
    clientRepresentative: {
        type: String,
        required: true
    },
    leader: {
        type: String,
        required: true
    }, 
    manager: {
        type: String,
        required: true
    }
})

const Project = mongoose.model('projects', ProjectSchema)


module.exports = Project;