const { ObjectId } = require('mongodb');
var mongoose = require('mongoose');


const ClientSchema  = new mongoose.Schema({
    companyId: {
        type: ObjectId,
        required: true
    },
    representatives:{
        type: Map,
        of: String
    }
})

const Client = mongoose.model('clients', ClientSchema)


module.exports = Client;