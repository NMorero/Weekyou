const { ObjectId } = require('mongodb');
var mongoose = require('mongoose');


const ReminderSchema  = new mongoose.Schema({
    content: {
        type: String,
        required: true
    }, 
    status: {
        type: Boolean,
        required: true
    }, 
    order: {
        type: Number,
        required: true
    }, 
    page: {
        type: Number,
        required: true
    }, 
    userId: {
        type: ObjectId,
        required: true
    }
})

const Reminder = mongoose.model('reminders', ReminderSchema)


module.exports = Reminder;