const { ObjectId } = require('mongodb');
var mongoose = require('mongoose');


const ProjectDeveloperSchema  = new mongoose.Schema({
    developerId: {
        type: ObjectId,
        required: true
    }, 
    projectId: {
        type: ObjectId,
        required: true
    }
})

const ProjectDeveloper = mongoose.model('project_developers', ProjectDeveloperSchema)


module.exports = ProjectDeveloper;