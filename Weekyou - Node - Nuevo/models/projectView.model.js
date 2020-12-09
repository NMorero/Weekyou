const { ObjectId } = require('mongodb');
var mongoose = require('mongoose');


const ProjectViewSchema  = new mongoose.Schema({
    image: {
        type: String,
        required: true
    }, 
    projectId: {
        type: ObjectId,
        required: true
    }, 
    
})

const ProjectView = mongoose.model('project_views', ProjectViewSchema)


module.exports = ProjectView;