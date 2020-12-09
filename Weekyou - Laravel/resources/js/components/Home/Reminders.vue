<template>
    <div class="col-8 row justify-content-between  pl-0 shadow rounded-lg bg-white reminderBox">
        <draggable class="list-group scroll-reminders p-3 px-4 list-group" :list="remindersFiltered" group="people" @change="orderReminders">
            <div class="list-group-item" v-for="(reminder, index) in remindersFiltered" :key="'Reminder'+index">
                <span v-if="reminder.status == 1" @click="changeStatus(2, reminder.id)">{{reminder.message}}</span>
                <span v-else @click="changeStatus(1, reminder.id)"><strike>{{reminder.message}}</strike></span>
                <button @click="deleteReminder(reminder.id)">X</button>
            </div>
        </draggable>

        <div class="pagePanel mb-0">
            <p class="mb-0">
                <a @click="showDots = true" class="dotsReminderTab" style="cursor:pointer;"><i class="fas fa-ellipsis-v"></i></a>
                <a @click="pagePrev()" style="cursor:pointer;"><i class="fas fa-arrow-circle-left"></i></a>
                <span id="pageId" >{{actualPageTitle}}</span>
                <a @click="openModalAddPage()" style="cursor:pointer;" v-if="addButtonPage"><i class="fas fa-plus-circle"></i></a>
                <a @click="pageNext()" style="cursor:pointer;" v-else><i class="fas fa-arrow-circle-right"></i></a>
            </p>
                <div class="dotsTabRemindersBox shadow " v-if="showDots">
                    <button @click="openChangePageTitle">Edit page</button>
                    <button @click="showDots = false">Close</button>
                </div>
        </div>
        <button class="btn-sm rounded-pill button-actions  bg-white py-0 btnAddReminder" data-toggle="modal" data-target="#modalReminder">+ Reminder</button>

        <div class="modal fade" id="modalReminder" tabindex="-1" role="dialog" aria-labelledby="modalReminderLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                    <h5 class="modal-title" id="modalReminderLabel">New Reminder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" class="row" id="ReminderBtnForm" @submit="addReminder">
                            <div class="form-group col-12">
                                <label for="ReminderBtnMessage" class="text-muted">Message</label>
                                <textarea v-model="newReminderInput" name="ReminderBtnMessage" id="ReminderBtnMessage" class="form-control" cols="20" rows="3" required ></textarea>
                            </div>
                            <div class="modal-footer col-12">
                            <button type="button" class="btn btn-secondary" id="closeReminder" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="submitReminder">Done</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showModalAddPage" v-bind:style="{ opacity: opacityModalAddPage}" class="modalAddPageBg">
            <div class="modalAddPage">
                <div class="modalAddPageHeader">
                    <h4>New reminders page</h4>
                </div>
                <form action="" @submit="addPage" class="formAddPage">
                    <input type="text" placeholder="Page title" v-model="newReminderPageInput" maxlength="25">
                    <div class="justify-content-around row boxBtnsAddPage">
                        <button type="button" class=" col-4 btn btn-secondary" @click="hideAddPagemodal">Cancel</button>
                        <button type="submit" class=" col-4 btn btn-primary">Done</button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="showModalChangePageTitle" v-bind:style="{ opacity: opacityModalChangePageTitle}" class="modalAddPageBg">
            <div class="modalAddPage">
                <div class="modalAddPageHeader">
                    <h4>Change page title</h4>
                </div>
                <form action="" @submit="changePageName" class="formAddPage">
                    <input type="text" placeholder="Page title" v-model="actualPageTitle" maxlength="25">
                    <div class="justify-content-around row boxBtnsAddPage">
                        <button type="button" class=" col-4 btn btn-secondary" @click="hideChangePageTitle">Cancel</button>
                        <button type="submit" class=" col-4 btn btn-primary">Done</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
    data: function () {
        return {
            reminders: [],
            actualPage: 1,
            newReminderInput: '',
            actualPageTitle: '',
            actualPageId: 0,
            showModalAddPage: false,
            opacityModalAddPage: 0,
            newReminderPageInput: '',
            showModalChangePageTitle: false,
            opacityModalChangePageTitle: 0,
            showDots: false
        }
    },
    created(){
        var self = this;
        Object.values(self.reminders)
        axios.get('/getReminders')
            .then(function (response) {
                self.reminders = response.data;
                self.reminders = Object.values(self.reminders);
                console.log(self.reminders);
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    computed:{
        remindersFiltered: function () {
            var self = this;
            console.log(self.actualPage);
            console.log(self.reminders.length);
            var filter = self.reminders.filter(page => page.page == self.actualPage);
            console.log(filter);
            if(filter[0]){
                self.actualPageTitle = filter[0].title;
                self.actualPageId = filter[0].id;
                console.log(filter[0].title);
                return filter[0].reminders;
            }
        },
        addButtonPage: function (){
            var self = this;
            var rems = this.reminders;
            if(rems){
                if(self.actualPage == rems.length){
                    return true;
                }else{
                    return false;
                }
            }
        }
    },
    methods: {
        changePageName(e){
            e.preventDefault();
            var self = this;
            self.showDots = false;
            var obj = {title: self.actualPageTitle, id: self.actualPageId};
            console.log(obj);
            self.reminders[this.actualPage-1].title = obj.title;
            self.hideChangePageTitle();
            axios.get('/reminderChangePageName/'+JSON.stringify(obj))
            .then(function (response) {
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        hideChangePageTitle(){
            var self = this;
            this.opacityModalChangePageTitle = 0;
            self.showDots = false;
            setTimeout(function(){
                self.showModalChangePageTitle = false;
            },300);
        },
        openChangePageTitle(){
            var self = this;
            self.showModalChangePageTitle = true;
            setTimeout(function(){
                self.opacityModalChangePageTitle = 1;
            },100);
        },
        openModalAddPage(){
            var self = this;
            this.showModalAddPage = true;
            setTimeout(function(){
                self.opacityModalAddPage = 1;
            },100);

        },
        hideAddPagemodal(){
            var self = this;
            this.opacityModalAddPage = 0;
            setTimeout(function(){
                self.showModalAddPage = false;
            },300);
        },
        addPage(e){
            e.preventDefault();
            var self = this;
            console.log(self.newReminderPageInput);
            var newPage = {
                id:'temp',
                page: self.actualPage+1,
                reminders: [],
                title: self.newReminderPageInput
            };
            self.reminders.push(newPage)
            var obj = {title: self.newReminderPageInput, page_number: self.actualPage+1};
            self.actualPage++;
            axios.get('/addReminderPage/'+JSON.stringify(obj))
            .then(function (response) {
                self.hideAddPagemodal();
                self.newReminderPageInput = '';
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        pageNext(){
            if(this.actualPage == this.reminders.length){
                console.log('No hay mas paginas');
            }else{
                this.actualPage++;
            }
        },
        pagePrev(){
            if(this.actualPage == 1){
                console.log('No hay mas paginas');
            }else{
                this.actualPage--;
            }
        },
        addReminder(e){
            e.preventDefault();
            var self = this;
            var order = this.reminders[this.actualPage-1].reminders.length+1;
            this.reminders[this.actualPage-1].reminders.push({id: 'temp', message: this.newReminderInput, page: this.actualPage, order: order, status: 1});
            document.getElementById('closeReminder').click();
            var jsonData = JSON.stringify({message: this.newReminderInput, page: this.actualPage, order: order});
            axios.get('/addReminder/'+jsonData)
            .then(function (response) {
                console.log('Reminder subido');
                console.log(response.data.id);
                var length = self.reminders[self.actualPage-1].reminders.length;
                self.reminders[self.actualPage-1].reminders[length-1].id = response.data.id;
                console.log(self.reminders[self.actualPage-1].reminders);
            })
            .catch(function (error) {
                console.log(error);
            });
            this.newReminderInput = '';
        },
        deleteReminder(id){
            var self = this;
            axios.get('/deleteReminder/'+id)
            .then(function (response) {
                console.log('Reminder eliminado');
                var filteredReminders = self.reminders[self.actualPage-1].reminders.filter(reminder => reminder.id != id);
                self.reminders[self.actualPage-1].reminders = filteredReminders;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        orderReminders(e){
            var remindersJson = JSON.stringify(this.reminders[this.actualPage-1].reminders);
            axios.get('/orderReminders/'+remindersJson)
            .then(function (response) {
                console.log('Reminder actualizado');
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        changeStatus(status, id){
            var self = this;
            if(status==1){
                self.reminders[self.actualPage-1].reminders.forEach(reminder => {
                    if(reminder.id == id){
                        reminder.status = 1
                    }
                });
            }else{
                self.reminders[self.actualPage-1].reminders.forEach(reminder => {
                    if(reminder.id == id){
                        reminder.status = 2
                    }
                });
            }
            axios.get('/UpdateReminder/'+id)
            .then(function (response) {
                console.log('Reminder actualizado');
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>

<style>
.dotsReminderTab{
    margin-right: 3%;
}

.dotsTabRemindersBox{
        position: fixed;
        left: 18%;
        top: 65%;
        z-index: 1050;
        background-color: #fff;
        width: 8vw;
        height: 10vh;
        border-radius: 10px;
        padding: 0.5%;
}
.dotsTabRemindersBox button{
    width: 99%;
    height: 50%;
    text-align: center;
    border: none;
    background-color: #fff;
    transition: all 0.3s ease-in-out;
    border-radius: 10px;
}

.dotsTabRemindersBox button:hover{
    background-color:aquamarine;
}
.formAddPage{
    width: 90%;
}

.formAddPage input{
    width: 60%;
    border: none;
    border-bottom: 1px solid rgba(77, 77, 77);
    text-align: center;
    margin-left: 25%;
    margin-top: 5%;
}

.boxBtnsAddPage{
    width: 80%;
    margin-left: 15%;
    margin-top: 10%;
}

.modalAddPageBg{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    display: block;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
    background-color: rgb(0, 0, 0, 0.5);
    transition: all 0.3s ease-in-out;
}
.modalAddPage{
    width: 40%;
    height: 40%;
    margin-left: 30%;
    margin-top: 15%;
    background-color: #fff;
    border-radius: 10px;
}
.modalAddPageHeader{
    height: 30%;
    background-color: #17a2b8;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.modalAddPageHeader h4{
    color: #fff;
    text-align: left;
    padding-left: 3%;
    padding-top: 4%;
}
.list-group-item{
    padding: 2%;
    width: 100%;
    border: none;
    border-bottom: 1px solid rgb(224, 224, 224) !important;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}
.list-group-item:hover{
    background-color: aquamarine;
}

.list-group-item:hover button{
    background-color: aquamarine;
}
.list-group-item span{
    display: inline-block;
    width: 88%;
}

.list-group-item button{
    display: inline-block;
    width: 10%;
    border: none;
    transition: all 0.3s ease-in-out;
    background-color: #fff;
}
.list-group{
    width: 98%;
    margin-left: 1%;
}

.pagePanel{
    width: 70%;
    text-align: left;
    padding-left: 3%;
}

.btnAddReminder{
    position: relative;
    right: 3%;
    bottom: 1%;
    outline: none;
}
</style>
