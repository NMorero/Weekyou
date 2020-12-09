const Client = require('../models/client.model');

exports.getClients = async function (){
    try {
        var clients = await Client.find();
        return clients;
    } catch (e) {
        throw Error('Error while Paginating Clients: ' + e)
    }
}

exports.getClientById = async function (id) {
    try {
        var client = await Client.findOne({_id: id});
        return client;
    } catch (e) {
        // Log Errors
        throw Error('Error while Paginating Client ' + e)
    }
}

exports.createClient = async function (data){
    if (data.representatives) {
        var client = new Client({
            companyId: data.companyId,
            representatives: data.representatives
        })
    } else {
        var client = new Client({
            companyId: data.companyId
        })
    }
    var upload = await client.save().catch(err => err);
    if(upload.companyId){
        return { status: 1 }
    } else {
        return { status: 0, error: upload }
    }
}

exports.deleteClient = async function (id) {
    try {
        var status = await Client.deleteOne({_id: id}).catch(err => err);
        if(status.n == 1){
            return {status: 1}
        }else{
            return {status: 0}
        }
    } catch (e) {
        // Log Errors
        throw Error('Error while Deleting Clients ' + e)
    }
}


exports.updateClient = async function (data) {
    client = await Client.findOne({_id: data.id});
    client.companyId = data.companyId;
    client.representatives = data.representatives;
    var upload = await user.save().catch(err => err);
    if(upload.companyId){
        return {status: 1}
    }else{
        return {status: 0, error: upload}
    }
}