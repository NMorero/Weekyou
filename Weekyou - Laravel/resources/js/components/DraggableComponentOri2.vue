<template>
    <div>
        <button id="btnOpenAddProjetc" @click="addProjectModal = true">+ Project</button>

        <div id="boxAddProjectModal" v-if="addProjectModal" @click="handleClickModalAddProject">
            <div id="addProject">
                <div id="headerAddProject">
                    <span>Add project</span>
                </div>
                <form action="" @submit="submitFormProject">
                    <input type="text" placeholder="Project name" class="inputInline" required v-model="projectNameModal">
                    <input type="text" placeholder="Project alias" class="inputInline" required v-model="projectAliasModal">
                    <input type="text" required class="inputInline" placeholder="Delivery date" onfocus="(this.type='date')" v-model="projectDateModal">
                    <select name="" id="" class="inputInline" required v-model="projectClientModal">
                        <option value="" selected hidden>Selet client</option>
                        <option :value="client.id" v-for="client in clients" :key="client.id">{{client.client_name}}</option>
                    </select>
                    <select name="" id="" class="inputInline" required v-model="projectManagerModal">
                        <option value="" selected hidden>Selet manager</option>
                        <option :value="man.id" v-for="man in managers" :key="man.id">{{man.username}}</option>
                    </select>
                    <select name="" id="" class="inputInline" required v-model="projectLeaderModal">
                        <option value="" selected hidden>Selet leader</option>
                        <option :value="lead.id" v-for="lead in leaders" :key="lead.id">{{lead.username}}</option>
                    </select>
                    <label class="file-select">
                        <!-- We can't use a normal button element here, as it would become the target of the label. -->
                        <div class="select-button">
                        <!-- Display the filename if a file has been selected. -->
                        <span v-if="value">{{value}}</span>
                        <span v-else>Select File</span>
                        </div>
                        <!-- Now, the file input that we hide. -->
                        <input type="file" id="inputProjectFile" @change="handleFileChange"/>
                    </label>
                    <button type="submit" id="btnSaveAddProject">Save</button>
                </form>
            </div>
        </div>

        <div id="boxEditProjectModal" v-if="modalEditProject" @click="handleClickModalEditProject">
            <div id="editProject">
                <div id="headerEditProject">
                    <span>Edit project</span>
                </div>
                <form action="" @submit="submitFormEditProject">
                    <label for="projectNameEditModal">Project name</label>
                    <input id="projectNameEditModal" type="text"  class="inputInline" required v-model="projectActual[0].project_name">
                    <label for="projectAliasEditModal">Project alias</label>
                    <input id="projectAliasEditModal" type="text"  class="inputInline" required v-model="projectActual[0].alias">
                    <label for="projectClientEditModal">Client</label>
                    <select name="" id="projectClientEditModal" v-model="projectActual[0].client_id" class="inputInline" @change="updateClientProjectAct()">
                        <option :value="projectActual[0].client_id" selected>{{projectActual[0].client}}</option>
                        <option v-for="client in restsOfClients" :key="client.id" :value="client.id">{{client.client_name}}</option>
                    </select>
                    <label for="projectManagerEditModal">Manager</label>
                    <select name="" id="projectManagerEditModal" v-model="projectActual[0].manager_id" class="inputInline" @change="updateManagerProjectAct()">
                        <option :value="projectActual[0].manager_id" selected>{{projectActual[0].manager.name}} {{projectActual[0].manager.lastName}}</option>
                        <option v-for="manager in restsOfManagers" :key="manager.id" :value="manager.id">{{manager.name}} {{manager.lastName}}</option>
                    </select>
                    <label for="projectLeaderEditModal">Leader</label>
                    <select name="" id="projectLeaderEditModal" v-model="projectActual[0].leader_id" class="inputInline" @change="updateLeaderProjectAct()">
                        <option :value="projectActual[0].leader_id" selected>{{projectActual[0].leader.name}} {{projectActual[0].leader.lastname}}</option>
                        <option v-for="leader in restsOfLeaders" :key="leader.id" :value="leader.id">{{leader.name}} {{leader.lastName}}</option>
                    </select>

                    <button type="submit" id="btnSaveEditProject">Save</button>
                </form>
            </div>
        </div>

        <div v-if="modal" id="boxModalProject" @click="handleClickModal">
            <div id="modalProject">
                <div id="headerModalProject" >
                    <span id="tituloModalProject">{{projectActual[0].project_name}} // {{projectActual[0].client}}</span>
                    <span id="leaderModalProject">{{projectActual[0].leader.name}}  {{projectActual[0].leader.lastname}}</span>
                </div>
                <div id="boxImgs">
                    <div id="boxImgModalProject">
                        <img class="img-d-block" :src="projectActual[0].thumbnail" alt="">
                    </div>
                    <div id="boxViewsModalProject">
                        <div class="viewModalProject" v-for="view in projectActual[0].views" :key="view.id">
                            <img class="imgViewModalProjects" :src="view.img" alt="">
                            <span class="titleViewModalProjects">{{view.title}}</span>
                        </div>
                        <span class="add" @click="modalView = true">+</span>
                    </div>
                </div>

                <div id="boxTaskModalProject">
                    <div class="listTaskModalProject" v-for="devs in projectActual[0].devs.devsLists" :key="devs.id">
                        <span class="titleListTaskModalProject" >{{devs.name}}</span>
                        <div class="tasksModalProject" v-for="devsMod in devs.modules" :key="devsMod.id">
                            <span class="titleTaskModalProject">{{devsMod.module}}</span>
                            <span class="devTaskModalProject">{{devsMod.developer}}</span>
                        </div>
                        <span class="add" @click="openModalAddTask(devs.name)">+</span>
                    </div>
                    <span class="addList" @click="listModal = true">+</span>

                </div>
                <button id="btnModalEditProject" @click="openModalEditProject()">Edit</button>
            </div>
        </div>

        <div id="addViewModal" v-if="modalView" @click="handleClickModalView">
            <div id="modalView">
                <div id="headerModalAddView">
                    <span>Add view</span>
                </div>
                <form @submit="submitFormView" enctype="multipart/form-data" id="formAddView">

                    <input type="text" name="viewTitle" id="inputViewTitle" placeholder="View title" v-model="viewTitle">

                    <label class="file-select">
                        <!-- We can't use a normal button element here, as it would become the target of the label. -->
                        <div class="select-button">
                        <!-- Display the filename if a file has been selected. -->
                        <span v-if="value">{{value}}</span>
                        <span v-else>Select File</span>
                        </div>
                        <!-- Now, the file input that we hide. -->
                        <input type="file" id="inputViewFile" @change="handleFileChange"/>
                    </label>
                    <input type="submit" id="btnSaveView" value="Save" />
                </form>
            </div>
        </div>
        <div id="addTaskModal" v-if="taskModal" @click="handleClickModalTask">
            <div id="modalTask">
                <div id="headerModalAddTask">
                    <span>Add Task</span>
                </div>
                <form action="" @submit="submitFormTask">
                    <input type="text" name="taskList" class="inputTaskTitle" placeholder="Task list" v-model="taskList">
                <input type="text" name="taskTitle" class="inputTaskTitle" placeholder="Task title" v-model="taskTitle">
                <select name="taskDeveloper" id="taskDeveloper" class="inputTaskTitle" v-model="taskDeveloper">
                    <option value="" selected hidden>Developer</option>
                    <option :value="deve.id" v-for="deve in developers" :key="deve.id">{{deve.user}}</option>
                </select>
                <input type="submit" id="btnSaveTask" value="Save" />
                </form>
            </div>
        </div>



        <div id="addListModal" v-if="listModal" @click="handleClickModalList">
            <div id="addList">
                <input type="text" placeholder="List title" v-model="newListTask">
                <button id="btnAddList" @click="addList">Add</button>
            </div>
        </div>

        <div id="box1" class="boxProject">
            <h3 class>NEXT</h3>
            <draggable class="list-group" :list="list1" group="people" @change="log1" :disabled="!enabled">
                <div class="list-group-item" v-for="(element, index) in list1" :key="index+'list1'">
                    <span class="clientText">{{element.client}}</span>
                    <span class="projectText">{{element.alias}}</span>
                    <div class="boxInfoProjects" @click="handleClickProject(element.id)">
                        <div class="boxImg1">
                            <img class="imgVie" v-for="(view, index2) in element.views" :key="index2+'view1'" :src="view.img" alt />
                        </div>
                        <div class="boxImg2">
                            <img :src="element.thumbnail" alt class="imgDash"/>
                        </div>
                        <div class="taskLabelProject" v-for="(dev, index3) in element.devs.devs" :key="index3+'developer1'">
                            <span class="label1">Model stage</span>
                            <span class="label2">{{dev.module}}</span>
                            <span class="label3">{{dev.developer}}</span>
                        </div>
                    </div>
                </div>
            </draggable>
        </div>
        <div id="vl1"></div>

        <div id="box2" class="boxProject">
            <h3 class>ON GOING</h3>
            <draggable class="list-group" :list="list2" group="people" @change="log2" :disabled="!enabled">
                <div class="list-group-item" v-for="(element, index) in list2" :key="index+'list2'">
                    <span class="clientText">{{element.client}}</span>
                    <span class="projectText">{{element.alias}}</span>
                    <div class="boxInfoProjects" @click="handleClickProject(element.id)">
                        <div class="boxImg1">
                            <img class="imgVie" v-for="(view, index2) in element.views" :key="index2+'view2'" :src="view.img" alt />
                        </div>
                        <div class="boxImg2">
                            <img :src="element.thumbnail" alt class="imgDash" />
                        </div>
                        <div class="taskLabelProject" v-for="(dev, index3) in element.devs.devs" :key="index3+'developer2'">
                            <span class="label1">Model stage</span>
                            <span class="label2">{{dev.module}}</span>
                            <span class="label3">{{dev.developer}}</span>
                        </div>
                    </div>
                </div>
            </draggable>
        </div>
        <div id="vl2"></div>
        <div id="box3" class="boxProject">
            <h3 class>AT CLIENT</h3>
            <draggable class="list-group" :list="list3" group="people" @change="log3" :disabled="!enabled">
                <div class="list-group-item" v-for="(element, index) in list3" :key="index+'list3'">
                    <span class="clientText">{{element.client}}</span>
                    <span class="projectText">{{element.alias}}</span>
                    <div class="boxInfoProjects" @click="handleClickProject(element.id)">
                        <div class="boxImg1">
                            <img class="imgVie" v-for="(view, index2) in element.views" :key="index2+'view3'" :src="view.img" alt />
                        </div>
                        <div class="boxImg2">
                            <img :src="element.thumbnail" alt class="imgDash" />
                        </div>
                        <div class="taskLabelProject" v-for="(dev, index3) in element.devs.devs" :key="index3+'developer3'">
                            <span class="label1">Model stage</span>
                            <span class="label2">{{dev.module}}</span>
                            <span class="label3">{{dev.developer}}</span>
                        </div>
                    </div>
                </div>
            </draggable>
        </div>
        <div id="vl3"></div>
        <div id="box4" class="boxProject">
            <h3 class>SUSPENDED</h3>
            <draggable class="list-group" :list="list4" group="people" @change="log4" :disabled="!enabled">
                <div class="list-group-item" v-for="(element, index) in list4" :key="index+'list4'">
                    <span class="clientText">{{element.client}}</span>
                    <span class="projectText">{{element.alias}}</span>
                    <div class="boxInfoProjects" @click="handleClickProject(element.id)">
                        <div class="boxImg1">
                            <img class="imgVie" v-for="(view, index2) in element.views" :key="index2+'view4'" :src="view.img" alt />
                        </div>
                        <div class="boxImg2">
                            <img :src="element.thumbnail" alt class="imgDash" />
                        </div>
                        <div class="taskLabelProject" v-for="(dev, index3) in element.devs.devs" :key="index3+'developer4'">
                            <span class="label1">Model stage</span>
                            <span class="label2">{{dev.module}}</span>
                            <span class="label3">{{dev.developer}}</span>
                        </div>
                    </div>
                </div>
            </draggable>
        </div>
        <div id="vl4"></div>
        <div id="box5" class="boxProject">
            <h3 class>FINISHED</h3>
            <draggable class="list-group" :list="list5" group="people" @change="log5" :disabled="!enabled">
                <div class="list-group-item" v-for="(element, index) in list5" :key="index+'list5'">
                    <span class="clientText">{{element.client}}</span>
                    <span class="projectText">{{element.alias}}</span>
                    <div class="boxInfoProjects" @click="handleClickProject(element.id)">
                        <div class="boxImg1">
                            <img class="imgVie" v-for="(view, index2) in element.views" :key="index2+'view5'" :src="view.img" alt />
                        </div>
                        <div class="boxImg2">
                            <img :src="element.thumbnail" alt class="imgDash" />
                        </div>
                        <div class="taskLabelProject" v-for="(dev, index3) in element.devs.devs" :key="index3+'developer5'">
                            <span class="label1">Model stage</span>
                            <span class="label2">{{dev.module}}</span>
                            <span class="label3">{{dev.developer}}</span>
                        </div>
                    </div>
                </div>
            </draggable>
        </div>

    </div>
</template>
<script>
import draggable from "vuedraggable";
import io from "socket.io-client";
//import func from '../../../vue-temp/vue-editor-bridge';
var socket = io.connect("http://weekyousocket.servehttp.com:4200");
export default {
  order: 1,
  components: {
    draggable

  },
  data() {
    return {
        viewUploaded: '',
        viewIdCounter: 1881818,
        viewTitle: '',
        taskModal: false,
        taskTitle: '',
        taskList: '',
        taskDeveloper: '',
        taskDeveloperAc: '',
        listModal: false,
        newListTask: '',
        actualClient: '',
        actualManager: '',
        actualManagerId: '',
        addProjectModal: false,
        projectNameModal: '',
        projectDateModal: '',
        projectManagerModal: '',
        projectLeaderModal: '',
        projectClientModal: '',
        projectAliasModal: '',
        value: '',
        modal: false,
        modalView: false,
        modalEditProject: false,
        file: '',
        projects: [],
        projectActual: [],
        list1: [],
        list2: [],
        list3: [],
        list4: [],
        list5: [],
        enabled: false,
        username: '',
        lastname: '',
        developers: [],
        clients: [],
        managers: [],
        leaders: [],
    };
    },
    computed:{

        restsOfClients: function() {
                var projectAct = this.projectActual[0];
                return this.clients.filter(function(client) {
                    return  client.client_name != projectAct.client;
                });
        },
        restsOfLeaders: function() {
                var projectAct = this.projectActual[0];
                return this.leaders.filter(function(leader) {
                    return  leader.id != projectAct.leader_id;
                });
        },
        restsOfManagers: function() {
            var projectAct = this.projectActual[0];
            return this.managers.filter(function(manager) {
                return  manager.id != projectAct.manager_id;
            });
        },

    },
    methods: {
        updateClientProjectAct: function(){
            var projectAct = this.projectActual[0];
            var clientSelect =  this.clients.filter(function(client) {
                return  client.id == projectAct.client_id;
            });
            return this.projectActual[0].client = clientSelect[0].client_name;
        },
        updateManagerProjectAct: function(){
            var projectAct = this.projectActual[0];
            var managerSelect =  this.managers.filter(function(manager) {
                return  manager.id == projectAct.manager_id;
            });
            var managerNew = {name: managerSelect[0].name, lastName: managerSelect[0].lastName}
            return this.projectActual[0].manager = managerNew;
        },
        updateLeaderProjectAct: function(){
            var projectAct = this.projectActual[0];
            var leaderSelect =  this.leaders.filter(function(leader) {
                return  leader.id == projectAct.leader_id;
            });
            var leadernew = {name: leaderSelect[0].name, lastname: leaderSelect[0].lastName}
            return this.projectActual[0].leader = leadernew;
        },
    addList: function(){

        console.log(this.projectActual[0]['devs']['devsLists']);
        this.viewIdCounter = this.viewIdCounter + 1;
        //this.projectActual[0]['devs']['devsLists'];
        var project = this.projectActual[0];
        project['devs']['devsLists'].push({
            name: this.newListTask,
            id: this.viewIdCounter,
            modules: []
        });
        this.projectActual[0] = project;
        this.newListTask = '';
        console.log(this.projectActual[0]);
        this.listModal = false;
    },
    handleClickModal: function(event){
        console.log(event.target)
        if(event.target.id=='boxModalProject'){
            this.modal = false;
        }
    },
    handleClickModalEditProject: function(event){
        console.log(event.target)
        if(event.target.id=='boxEditProjectModal'){
            this.modalEditProject = false;
        }
    },
    handleClickModalView: function(event){
        console.log(event.target)
        if(event.target.id=='addViewModal'){
            this.modalView = false;
        }
    },
    handleClickModalTask: function (){
        if(event.target.id == 'addTaskModal'){
            this.taskModal = false;
            this.taskDeveloper = '';
        }
    },
    handleClickModalList: function (){
        if(event.target.id == 'addListModal'){
            this.listModal = false;

        }
    },
    handleClickModalAddProject: function (){
        if(event.target.id == 'boxAddProjectModal'){
            this.addProjectModal = false;

        }
    },
    handleFileChange(e) {
      // Whenever the file changes, emit the 'input' event with the file data.
      this.value = e.target.files[0].name;
      this.file = e.target.files[0];
    },
    openModalEditProject(){
        this.modalEditProject = true;
    },
    handleClickProject(id){
        console.log(id);
        this.projectActual = this.projects.filter((obj) => {
            return obj.id == id;
        });
        this.actualClient = this.projectActual[0].client;
        this.actualManager = this.projectActual[0].manager;
        this.actualManagerId = this.projectActual[0].manager_id;
        console.log(this.projectActual);
        this.modal = true;
    },
    openModalAddTask(name){
        this.taskList = name;
        this.taskModal = true;
    },
    submitFormEditProject(e){
        e.preventDefault();
        let self = this;
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        }
        let formData = new FormData();
        formData.append('projectId', self.projectActual[0].id);
        formData.append('projectName', self.projectActual[0].project_name);
        formData.append('projectClient', self.projectActual[0].client_id);
        formData.append('projectManager', self.projectActual[0].manager_id);
        formData.append('projectLeader', self.projectActual[0].leader_id);
        formData.append('projectAlias', self.projectActual[0].alias);
        axios.post('/Admin/Projects/editProject', formData, config)
            .then(function (response) {
                self.modalEditProject = false;
                console.log('ok');
            })
            .catch(function (error) {
                self.output = error;
                alert('There was an error while uploading project');
            });
    },
    submitFormProject(e){
        e.preventDefault();
        let self = this;
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        }
        let formData = new FormData();
        formData.append('projectName', self.projectNameModal);
        formData.append('projectDate', self.projectDateModal);
        formData.append('projectClient', self.projectClientModal);
        formData.append('projectManager', self.projectManagerModal);
        formData.append('projectLeader', self.projectLeaderModal);
        formData.append('projectAlias', self.projectAliasModal);
        formData.append('thumbnail', self.file);
        var client = self.clients.filter((obj) => {
            return obj.id == self.projectClientModal;
        });
        console.log(client);

        var man = self.managers.filter((obj) => {
            return obj.id == self.projectManagerModal;
        });
        var lead = self.leaders.filter((obj) => {
            return obj.id == self.projectLeaderModal;
        });
        var f = document.getElementById( 'inputProjectFile' );
        var reader = new FileReader();
        reader.readAsDataURL(f.files[0]);
        reader.onload = function(e) {
            self.viewUploaded = e.target.result;
            axios.post('/Admin/Projects/addProject', formData, config)
            .then(function (response) {
                self.list1.push({
                    // CAMBIA A FILTRAR ARRAY CLIENTS  LEADERS Y MANAGERS, THUMBNAIL Y ID DESDE RESPONSE
                    client:client[0].client_name,
                    client_id:self.projectClientModal,
                    devs:{devs:[], devsLists:[]},
                    id:response.data.id,
                    alias:self.projectAliasModal,
                    leader:{
                        name:lead[0].name,
                        lastname:lead[0].last_name
                    },
                    leader_id: self.projectLeaderModal,
                    project_name: self.projectNameModal,
                    status: 'next',
                    thumbnail: response.data.thumbnail,
                    views: [],
                });
                self.projects.push({
                    // CAMBIA A FILTRAR ARRAY CLIENTS  LEADERS Y MANAGERS, THUMBNAIL Y ID DESDE RESPONSE
                    client:client[0].client_name,
                    client_id:self.projectClientModal,
                    devs:{devs:[], devsLists:[]},
                    id:response.data.id,
                    alias:self.projectAliasModal,
                    leader:{
                        name:lead[0].name,
                        lastname:lead[0].last_name
                    },
                    leader_id: self.projectLeaderModal,
                    project_name: self.projectNameModal,
                    status: 'next',
                    thumbnail: response.data.thumbnail,
                    views: [],
                });
                self.addProjectModal = false;
                self.projectNameModal = '';
                self.projectDateModal = '';
                self.projectManagerModal = '';
                self.projectLeaderModal = '';
                self.projectClientModal = '';
                self.projectAliasModal = '';
                self.value = '';
                self.file = '';
            })
            .catch(function (error) {
                self.output = error;
                alert('There was an error while uploading project');
            });
        };
    },
    submitFormTask(e) {
        e.preventDefault();
        let self = this;
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        }
        let formData = new FormData();
        formData.append('id', self.projectActual[0].id);
        formData.append('list', self.taskList);
        formData.append('title', self.taskTitle);
        formData.append('developer', self.taskDeveloper);
        //console.log(self.projectActual[0]['devs']['devsLists'][self.taskList].modules);
        self.taskDeveloperAc = self.developers.filter((obj) => {
            return obj.id == self.taskDeveloper;
        });
        //console.log(self.taskDeveloperAc[0]);
        self.taskDeveloperAc = self.taskDeveloperAc[0].user.substring(0,2);
        axios.post('/Admin/Projects/Module/Add', formData, config)
            .then(function (response) {
                self.viewIdCounter = self.viewIdCounter + 1;
                self.projectActual[0]['devs']['devsLists'].forEach((item, index) => {
                    if(item.name == self.taskList){
                        item.modules.push({developer:self.taskDeveloperAc, id:self.viewIdCounter, list_name:self.taskList,module:self.taskTitle });
                    }
                });
                //self.projectActual[0]['devs']['devsLists'][self.taskList].modules.push();
                if(self.projectActual[0].status == 'next'){
                    for (var i = 0; i < self.list1.length; i++) {
                        if(self.list1[i].id == self.projectActual[0].id){
                            self.list1[i]['devs']['devs'].push({developer:self.taskDeveloperAc, id:self.viewIdCounter, list_name:self.taskList,module:self.taskTitle })
                        }
                    }
                }else if(self.projectActual[0].status == 'ongoing'){
                    for (var i = 0; i < self.list2.length; i++) {
                        if(self.list2[i].id == self.projectActual[0].id){
                            self.list2[i]['devs']['devs'].push({developer:self.taskDeveloperAc, id:self.viewIdCounter, list_name:self.taskList,module:self.taskTitle })
                        }
                    }
                }else if(self.projectActual[0].status == 'atClient'){
                    for (var i = 0; i < self.list3.length; i++) {
                        if(self.list3[i].id == self.projectActual[0].id){
                            self.list3[i]['devs']['devs'].push({developer:self.taskDeveloperAc, id:self.viewIdCounter, list_name:self.taskList,module:self.taskTitle })
                        }
                    }
                }else if(self.projectActual[0].status == 'pause'){
                    for (var i = 0; i < self.list4.length; i++) {
                        if(self.list4[i].id == self.projectActual[0].id){
                            self.list4[i]['devs']['devs'].push({developer:self.taskDeveloperAc, id:self.viewIdCounter, list_name:self.taskList,module:self.taskTitle })
                        }
                    }
                }else if(self.projectActual[0].status == 'finished'){
                    for (var i = 0; i < self.list5.length; i++) {
                        if(self.list5[i].id == self.projectActual[0].id){
                            self.list5[i]['devs']['devs'].push({developer:self.taskDeveloperAc, id:self.viewIdCounter, list_name:self.taskList,module:self.taskTitle })
                        }
                    }
                }
                self.taskList = '';
                self.taskTitle = '';
                self.taskDeveloper = '';
                self.taskModal = false;
            })
            .catch(function (error) {
                self.output = error;
                alert(error);
            });
    },
    submitFormView(e) {
        e.preventDefault();
        let currentObj = this;
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        }
        // form data
        let formData = new FormData();
        formData.append('image', this.file);
        formData.append('title', this.viewTitle);
        var f = document.getElementById( 'inputViewFile' );
        var reader = new FileReader();
        reader.readAsDataURL(f.files[0]);
        reader.onload = function(e) {
            currentObj.viewUploaded = e.target.result;
            currentObj.projectActual[0].views.push({id: currentObj.viewIdCounter, img: currentObj.viewUploaded, title: currentObj.viewTitle});
            currentObj.viewUploaded = '';
            currentObj.viewTitle = '';
            currentObj.modalView = false;
        };

        // send upload request
        axios.post('/Admin/Projects/addView/'+ currentObj.projectActual[0].id, formData, config)
            .then(function (response) {
                currentObj.success = response.data.success;
                currentObj.value = "";
                currentObj.file = "";
                currentObj.viewTitle = "";
                currentObj.viewIdCounter = currentObj.viewIdCounter + 1;
            })
            .catch(function (error) {
                currentObj.output = error;
                alert('There was an error while uploading view');
            });
    },
    add: function() {
      this.list.push({ name: "Juan" });
    },
    replace: function() {
      this.list = [{ name: "Edgard" }];
    },
    clone: function(el) {
      return {
        name: el.name + " cloned"
      };
    },
    log1: function(evt) {
      if (evt.added) {
          console.log(evt.added.element);
        window.console.log("To dragg 1: ", evt.added.element.id);
        socket.emit('logAdd', {list:1, project:evt.added.element})
        axios.get('/Admin/Projects/Update/' + evt.added.element.id + '/1')
        .catch(function (error) {
            console.log(error);
        })
      }else if(evt.removed){
          socket.emit('logRem', {list:1, project:evt.removed.element})
      }
    },
    log2: function(evt) {
      if (evt.added) {
        window.console.log("To dragg 2: ", evt.added.element.id);
        socket.emit('logAdd', {list:2, project:evt.added.element})
        axios.get('/Admin/Projects/Update/' + evt.added.element.id + '/2')
        .catch(function (error) {
            console.log(error);
        })
      }else if(evt.removed){
          socket.emit('logRem', {list:2, project:evt.removed.element})
      }
    },
    log3: function(evt) {
      if (evt.added) {
        window.console.log("To dragg 3: ", evt.added.element.id);
        socket.emit('logAdd', {list:3, project:evt.added.element})
        axios.get('/Admin/Projects/Update/' + evt.added.element.id + '/3')
        .catch(function (error) {
            console.log(error);
        })
      }else if(evt.removed){
          socket.emit('logRem', {list:3, project:evt.removed.element})
      }
    },
    log4: function(evt) {
      if (evt.added) {
        window.console.log("To dragg 4: ", evt.added.element.id);
        socket.emit('logAdd', {list:4, project:evt.added.element})
        axios.get('/Admin/Projects/Update/' + evt.added.element.id + '/4')
        .catch(function (error) {
            console.log(error);
        })
      }else if(evt.removed){
          socket.emit('logRem', {list:4, project:evt.removed.element})
      }
    },
    log5: function(evt) {
      if (evt.added) {
        window.console.log("To dragg 5  : ", evt.added.element.id);
        socket.emit('logAdd', {list:5, project:evt.added.element})
        axios.get('/Admin/Projects/Update/' + evt.added.element.id + '/5')
        .catch(function (error) {
            console.log(error);
        })
      }else if(evt.removed){
          socket.emit('logRem', {list:5, project:evt.removed.element})
      }
    },

  },
    mounted(){
        let self = this;
        socket.on('connect', function(data) {
            console.log('Conected to websocket');
        });
        socket.on('logAdd', function(data) {
            console.log('Add: ' + data.project)
            if(data.list == 1){
                self.list1.push(data.project);
            }else if(data.list == 2){
                self.list2.push(data.project)
            }else if(data.list == 3){
                self.list3.push(data.project)
            }else if(data.list == 4){
                self.list4.push(data.project)
            }else if(data.list == 5){
                self.list5.push(data.project)
            }
        });
        socket.on('logRem', function(data) {
            console.log('Rem: ' + data.project)
            if(data.list == 1){
                self.list1 = self.list1.filter((obj) => {
                    return obj.id !== data.project.id;
                });
            }else if(data.list == 2){
                self.list2 = self.list2.filter((obj) => {
                    return obj.id !== data.project.id;
                });
            }else if(data.list == 3){
                self.list3 = self.list3.filter((obj) => {
                    return obj.id !== data.project.id;
                });
            }else if(data.list == 4){
                self.list4 = self.list4.filter((obj) => {
                    return obj.id !== data.project.id;
                });
            }else if(data.list == 5){
                self.list5 = self.list5.filter((obj) => {
                    return obj.id !== data.project.id;
                });
            }
        });

        axios.get('/Admin/Projects/get')
            .then(function (response) {
                self.projects = response.data[1];
                self.list1 = response.data[0][0];
                self.list2 = response.data[0][1];
                self.list3 = response.data[0][2];
                self.list4 = response.data[0][3];
                self.list5 = response.data[0][4];

            })
            .catch(function (error) {
                console.log(error);
            });
        axios.get('/Admin/UserRole')
            .then(function (response) {
                if(response.data[0] == 'admin' || response.data[0] == 'PRleader'){
                    self.enabled =true;
                }
                self.username = response.data[1];
                self.lastname = response.data[2];
            })
            .catch(function (error) {
                console.log(error);
            })
        axios.get('/Admin/Projects/Developers/get')
            .then(function (response) {
                console.log(response.data);
                self.developers = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        axios.get('/Admin/Info/Clients/Managers/Leaders')
            .then(function (response) {
                console.log(response.data);
                self.managers = response.data.managers;
                self.leaders = response.data.leaders;
                self.clients = response.data.clients;
            })
            .catch(function (error) {
                console.log(error);
            });
    },

};
</script>
<style scoped>
.addList{
    position: relative;
    cursor: pointer;
    color: #62dfc2;
    font-size: 2rem;

}
select { width: 400px; text-align-last:center; }
#headerModalAddTask{
    width: 100%;
    height: 20%;
    border-bottom: 1px solid darkgray;
    text-align: center;
    font-size: 2rem;
    margin-bottom: 10%;
}
#headerModalAddView{
    width: 100%;
    height: 20%;
    border-bottom: 1px solid darkgray;
    text-align: center;
    font-size: 2rem;
    margin-bottom: 10%;
}
#formAddView{
    padding-top: 10%;
    text-align: center;
}
#inputViewTitle{
    border: 0px;
    text-align: center;
    border-bottom: 1px solid darkgray;
    height: 8%;
    margin-left: 10%;
    margin-right: 10%;
    margin-bottom: 10%;
    width: 70%;
}
#btnSaveTask{
    margin-left: 15%;
    margin-right: 15%;
    width: 70%;
    padding: 2%;
    border-radius: 10px;
    background-color: #62dfc2;
    color: #fff;
    border: #62dfc2;
}
.inputTaskTitle{
    border: 0px;
    text-align: center;
    border-bottom: 1px solid darkgray;
    height: 8%;
    margin-left: 15%;
    margin-right: 15%;
    margin-bottom: 10%;
    width: 70%;
}
#formAddView span{
    font-size: 1.5rem;
}
label{
    margin-left: 10%;
    margin-right: 10%;
    width: 70%;
}
#btnSaveView{
    margin-left: 10%;
    margin-right: 10%;
    width: 70%;
    padding: 2%;
    border-radius: 10px;
    background-color: #62dfc2;
    color: #fff;
    border: #62dfc2;
}

.file-select > .select-button {
    padding: 0.5rem;
    border:3px solid #62dfc2;
    color: #62dfc2;
    display: inline-block;
    width: 100%;
    border-radius: .3rem;
    text-align: center;
}

/* Don't forget to hide the original file input! */
.file-select > input[type="file"] {
  display: none;
}
</style>
