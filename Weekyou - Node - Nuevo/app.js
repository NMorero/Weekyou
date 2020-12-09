// app.js
const express = require('express');  
const app = express();  
const server = require('http').createServer(app);  
const io = require('socket.io')(server);
const mongoose = require('mongoose');
const cors = require('cors');
const bodyParser = require('body-parser')

// ROUTES IMPORT
const UserRoutes = require('./routes/user.routes');
const PersonRoutes = require('./routes/person.routes');

app.use(cors());
app.use(express.static(__dirname + '/node_modules'));
app.use(bodyParser.json())

// MONGO DB
mongoose.connect('mongodb://localhost:27017/weekyou', {useNewUrlParser: true, useUnifiedTopology: true});
// MODELS
/*
!const ClientRepresentative = mongoose.model('client_representatives', {name: String, clientId: ObjectId});
const Client = mongoose.model('clients', {companyId: ObjectId});
const Company = mongoose.model('companies', {name: String, cuit: Number, alias: String, website: String, administratorName: String, administratorEmail: String, productionManagerName: String, productionemail: String, phoneNumber: Number, address: String, postalCode: Number, countryId: ObjectId, stateId: ObjectId, cityId: ObjectId});
! const Developer = mongoose.model('developers', {userId: ObjectId});
const Event = mongoose.model('events', {content: String, date: Date, userId: ObjectId, clientRepresentativeId: ObjectId, projectId: ObjectId, viewId: ObjectId});
! const Freelancer = mongoose.model('freelancers', {ivaCondition: String, accountBank: String, accountNumber: String, cbuNumber: String, familiContactName: String, familiContactNumber: Number, familiContactAddress: String})
const Project = mongoose.model('projects', {name: String, deliveryDate: Date, status: Number, alias: String, thumbnail: String, clientRepresentativeId: ObjectId, leaderId: ObjectId, managerId: ObjectId});
const ProjectDeveloper = mongoose.model('project_developers', {developerId: ObjectId, projectId: ObjectId});
! const ProjectLeader = mongoose.model('projects_leaders', {userId: ObjectId});
! const ProjectManager = mongoose.model('projects_manager', {userId: ObjectId});
const ProjectView = mongoose.model('projects_views', {Image: String});
! const Relationship = mongoose.model('relationships', {freelanceId: ObjectId, companyId: ObjectId});
const Reminder = mongoose.model('reminders', {content: String, status: Boolean, order: Number, page: Number, userId: ObjectId});
const ReminderPage = mongoose.model('remidner_pages', {title: String, page_number: Number, userId: Number});
const Task = mongoose.model('tasks', {content: String, status: Boolean, date: Date, createdBy: String, userId: ObjectId, projectId: ObjectId, clientRepresentativeId: ObjectId});
*/
// MONGODB FUNCTS


// APP ROUTES
app.use('/Users', UserRoutes);
app.use('/Persons', PersonRoutes);


console.log('Server On, Listening to port: 4200');
server.listen(4200);
