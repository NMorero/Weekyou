const { ObjectId } = require('mongodb');
var mongoose = require('mongoose');


const ReminderPageSchema  = new mongoose.Schema({
    title: {
        type: String,
        required: true
    }, 
    page_number: {
        type: Number,
        required: true
    }, 
    userId: {
        type: ObjectId,
        required: true
    }
})

const ReminderPage = mongoose.model('reminder_pages', ReminderPageSchema)


module.exports = ReminderPage;