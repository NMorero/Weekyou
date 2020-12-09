const { ObjectId } = require('mongodb');
var mongoose = require('mongoose');


const TaskSchema  = new mongoose.Schema({
    content: {
        type: String,
        required: true
    }, 
    status: {
        type: Boolean,
        required: true
    }, 
    date: {
        type: Date,
        required: true
    }, 
    createdBy: {
        type: String,
        required: true
    }, 
    userId: {
        type: ObjectId,
        required: true
    }, 
    project: {
        type: String,
        required: true
    }, 
    client: {
        type: String,
        required: true
    }
})

const Task = mongoose.model('tasks', TaskSchema)


module.exports = Task;