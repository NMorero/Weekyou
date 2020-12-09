<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/testLimit', function(){
    return view('testLimit');
});

Route::get('/Admin/UserRole', 'AdminController@getRole');

Route::get('/Admin/Delete/All/DB', 'AdminController@deleteDb');

Route::get('/', 'HomeController@index');

Auth::routes();

Route::post('/addTicket', 'HomeController@addTicket');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/changeTask/{task}/{comment}', 'HomeController@changeTask');

Route::get('/test', function(){
    return view('test');
});

Route::get('/getProjectsByClient/{client}', 'HomeController@getProjectsByClient');

Route::get('/getViewsByProject/{project}', 'HomeController@getViewsByProject');

Route::get('/getPosts/{client}/{project}/{view}', 'HomeController@getPosts');

Route::get('/deletePost/{id}', 'HomeController@deletePost');

Route::get('/getReminders', 'HomeController@getReminders');

Route::get('/getTemplates', 'HomeController@getTemplates');

Route::get('/UpdateReminder/{id}', 'HomeController@updateReminder');

Route::get('/deleteReminder/{id}', 'HomeController@deleteReminder');

Route::get('/getTasks', 'HomeController@getTasks');

Route::get('/deleteTask/{id}/{comm}', 'HomeController@deleteTask');

Route::get('/getUsers', 'HomeController@getUsers');

Route::get('/addReminder/{formData}', 'HomeController@addReminder');

Route::get('/addTask/{formData}', 'HomeController@addTask');

Route::get('/addPostTest/{formData}', 'HomeController@addPostTest' );

Route::post('/addPost', 'HomeController@addPost');

Route::get('/deleteFeedback/{id}', 'FeedbackController@deleteFeedback');

Route::get('/addEvent/{formData}', 'HomeController@addEvent');

Route::get('/addDelivery/{formData}', 'HomeController@addDelivery');

Route::get('/Feedback/Create', 'FeedbackController@create');

Route::get('/Feedback/getClients', 'FeedbackController@getClients');

Route::get('/Feedback/getProjects/{client}', 'FeedbackController@getProjects');

Route::get('/Feedback/Edit/{id}', 'FeedbackController@edit');

Route::post('/Feedback/Edit/saveFeedback', 'FeedbackController@saveFeedbackChange');

Route::post('/addFeedback', 'FeedbackController@addFeedback');

Route::get('/feedback/getProjectsByClient/{client}', 'HomeController@getProjectsByClient');

Route::get('/feedback/getViewsByProject/{project}', 'HomeController@getViewsByProject');

Route::get('/Admin', 'AdminController@home');

Route::get('/Admin/Info/Clients/Managers/Leaders', 'AdminController@infoClientsLeadersManagers');

Route::get('/Admin/Clients/Person', 'AdminController@pageClientsPersons');

Route::post('/Admin/Clients/Person/Update/{id}', 'AdminController@updateClientperson');

Route::get('/Admin/Clients/Person/getClientsPersons', 'AdminController@getClientsPersons');

Route::post('/Admin/addClientsPersons', 'AdminController@addClientsPersons');

Route::post('/Admin/Company/Update/{id}', 'AdminController@updateCompany');

Route::get('/Admin/Clients/Company', 'AdminController@pageClientsCompany');

Route::post('/Admin/addClientsCompany', 'AdminController@addClientsCompany');

Route::get('/Admin/Companies', 'AdminController@getCompaniesTable');

Route::get('/Admin/Companies/Delete/{id}', 'AdminController@deleteCompany');

Route::post('/Admin/Companies/addCompany', 'AdminController@addCompany');

Route::get('/Admin/Developers', 'AdminController@pageDevelopers');

Route::get('/Admin/Developers/Delete/{id}/', 'AdminController@deleteDeveloper');

Route::post('/Admin/Developers/addDeveloper', 'AdminController@addDeveloper');

Route::get('/Admin/Persons', 'AdminController@pagePersons');

Route::post('/Admin/Persons/Update/{id}', 'AdminController@updatePerson');

Route::get('/Admin/Persons/Delete/{id}', 'AdminController@deletePerson');

Route::post('/Admin/Persons/addPersons', 'AdminController@addPerson');

Route::post('/Admin/Managers/addProjectManager', 'AdminController@addPRManager');

Route::post('/Admin/Managers/addProjectLeader', 'AdminController@addPRLeader');

Route::get('/Admin/Projects/Managers', 'AdminController@pagePRManagers');

Route::get('/Admin/Projects/Managers/Delete/{id}', 'AdminController@deletePRManager');

Route::get('/Admin/Projects/Leaders', 'AdminController@pagePRLeaders');

Route::get('/Admin/Projects/Leaders/Delete/{id}', 'AdminController@deleteLeader');

Route::post('/Admin/Projects/addProject', 'AdminController@addProject');

Route::get('/Admin/Projects/get', 'AdminController@getProjects');

Route::get('/Admin/Projects/Deactivate/{id}', 'AdminController@desProject');

Route::get('/Admin/Projects/Activate/{id}', 'AdminController@acProject');

Route::get('/Admin/Projects/Developers/get', 'AdminController@getDevelopers');

Route::get('/Admin/Projects/Update/{id}/{status}', 'AdminController@updateProject');

Route::get('/Admin/Projects/Delete/{id}', 'AdminController@deleteProject');

Route::post('/Admin/Projects/addView/{id}', 'AdminController@addView');

Route::post('/Admin/Projects/Module/Add', 'AdminController@addModuleProject');

Route::get('/Admin/Project/Views/Delete/{id}', 'AdminController@deleteView');

Route::post('/Admin/Users/addUser', 'AdminController@addUser');

Route::post('/Admin/Users/Update/{id}', 'AdminController@updateUser');

Route::get('/Admin/Users/Delete/{id}', 'AdminController@deleteUser');

Route::get('/Admin/Users', 'AdminController@pageUsers');

Route::get('/Admin/Projects', 'AdminController@pageProjects');

Route::get('/Admin/Projects/Views/{id}', 'AdminController@pageViews');

Route::post('/Admin/Roles/addRol', 'AdminController@addRol');

Route::get('Admin/Roles', 'AdminController@pageRoles');

Route::get('/Admin/Roles/Delete/{id}', 'AdminController@deleteRol');

Route::post('/Admin/Relationships/Direct/Add', 'AdminController@addRelationDirect');

Route::post('/Admin/Relationships/Freelance/Add', 'AdminController@addRelationFreelance');

Route::get('/Admin/Relationships/Direct', 'AdminController@pageRelationDirect');

Route::get('/Admin/Relationships/Freelance', 'AdminController@pageRelationFreelance');
