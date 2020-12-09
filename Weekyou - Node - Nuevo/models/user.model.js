var mongoose = require('mongoose');


const UserSchema  = new mongoose.Schema({
    alias: {
        type: String,
        required: true
    },
    email: {
        type: String,
        required: true
    }, 
    password: {
        type: String,
        required: true
    }, 
    emailVerified: {
        type: Boolean,
        required: true
    }, 
    rememberToken: {
        type: String,
        required: false
    }, 
    person: { 
        type: Map,
        of: mongoose.Schema.Types.Mixed,
        required: false
    },
})

const User = mongoose.model('users', UserSchema)


module.exports = User;