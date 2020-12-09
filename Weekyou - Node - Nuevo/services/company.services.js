const Company = require('../models/company.model');

exports.getCompanies = async function (){
    try {
        var companies = await Company.find();
        return companies;
    } catch (e) {
        throw Error('Error while Paginating Companies: ' + e)
    }
}

exports.getCompanyById = async function (id) {
    try {
        var company = await Company.findOne({_id: id});
        return company;
    } catch (e) {
        // Log Errors
        throw Error('Error while Paginating Company ' + e)
    }
}

exports.createCompany = async function (data){
    var company = new Company({
        name: data.name,
        cuit: data.cuit,
        alias: data.alias,
        website: data.website,
        administratorName: data.administratorName,
        administratorEmail: data.administratorEmail,
        productionManagerName: data.productionManagerName,
        productionEmail: data.productionEmail,
        phoneNumber: data.phoneNumber,
        address: data.address,
        postalCode: data.postalCode,
        country: data.country,
        state: data.state,
        city: data.city,
    })
    var upload = await company.save().catch(err => err);
    if(upload.name){
        return { status: 1 }
    } else {
        return { status: 0, error: upload }
    }
}

exports.deleteCompany = async function (id) {
    try {
        var status = await Company.deleteOne({_id: id}).catch(err => err);
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


exports.updateCompany = async function (data) {
    var company = await Company.findOne({_id: data.id});
    company.name = data.name;
    company.cuit = data.cuit;
    company.alias = data.alias;
    company.website = data.website;
    company.administratorName = data.administratorName;
    company.administratorEmail = data.administratorEmail;
    company.productionManagerName = data.productionManagerName;
    company.productionEmail = data.productionEmail;
    company.phoneNumber = data.phoneNumber;
    company.address = data.address;
    company.postalCode = data.postalCode;
    company.country = data.country;
    company.state = data.state;
    company.city = data.city;
    var upload = await company.save().catch(err => err);
    if(upload.name){
        return {status: 1}
    }else{
        return {status: 0, error: upload}
    }
}