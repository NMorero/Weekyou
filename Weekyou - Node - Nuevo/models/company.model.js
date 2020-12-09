var mongoose = require('mongoose');


const CompanySchema  = new mongoose.Schema({
    name: {
        type: String,
        required: true
    }, 
    cuit: {
        type: Number,
        required: true
    }, 
    alias: {
        type: String,
        required: true
    }, 
    website: {
        type: String,
        required: false
    }, 
    administratorName: {
        type: String,
        required: true
    }, 
    administratorEmail: {
        type: String,
        required: true
    }, 
    productionManagerName: {
        type: String,
        required: true
    }, 
    productionEmail: {
        type: String,
        required: true
    }, 
    phoneNumber: {
        type: Number,
        required: true
    }, 
    address: {
        type: String,
        required: true
    }, 
    postalCode: {
        type: Number,
        required: true
    }, 
    country: {
        type: String,
        required: true
    }, 
    state: {
        type: String,
        required: true
    }, 
    city: {
        type: String,
        required: true
    }
})

const Company = mongoose.model('companies', CompanySchema)


module.exports = Company;