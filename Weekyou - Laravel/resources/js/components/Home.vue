<template>
    <div>
        <main class="container-fluid row d-lg-flex d-none justify-content-around px-2 m-0 bg-lightGrey" id="mainLG">
            <!-- Primera Sección -->
            <div class="col-6 row justify-content-between p-0 m-0 bg-lightGrey">
                <!-- Projects/Tasks -->
                <div class="col-4 row p-0 m-0  d-inline infoBox shadow border rounded-lg bg-white">
                </div>
                <!-- Reminders -->
                <!--
                <div class="col-8 row justify-content-between  pl-0">
                    <input type="number" value="1" id="actualPage" hidden >
                    <div class="col-12 row p-0  pr-1 m-0 shadow rounded-lg bg-white reminderBox">
                        <ul class="col-12  scroll-reminders p-3 px-4 list-group" id="remindersBox">
                        </ul>
                        <div class="col-9 mb-0 text-center">
                            <p class="mb-0"><a onclick="reminderPrev()" style="cursor:pointer;"><i class="fas fa-arrow-circle-left"></i></a>  Page <span id="pageId">1</span>  <a onclick="reminderNext()" style="cursor:pointer;"><i class="fas fa-arrow-circle-right"></i></a></p>
                        </div>
                        <button class="btn-sm rounded-pill button-actions col-3 bg-white py-0 " data-toggle="modal" data-target="#modalReminder">+ Reminder</button>
                    </div>
                </div>
                -->
                <Reminders></Reminders>
                <!-- Chat -->
                <div class="col-12 bg-white shadow rounded-lg border d-inline chat row p-0 m-0 mt-2">
                </div>
            </div>
            <!-- FIN  Primera Sección -->

            <!-- Segunda Sección -->
            <div class="col-6  row bg-lightGrey pr-5 justify-content-between">
                <!--
                    <div class="col-12 pt-3 row div-actions justify-content-between pr-0">
                        <button class="btn btn-info mr-1 col-3 button-actions" data-toggle="modal" data-target="#modalDelivery">Delivery</button>
                        <a href="/Feedback/Create" class="btn btn-info mr-0 my-1 ml-11 col-3">Feedback</a>
                    </div>
                -->
                <!-- Sección (Posts) -->
                <div class="col-7 row  shadow border rounded-lg d-inline p-3 pb-4 m-0 bg-white posts">
                    <div class="col-12 p-0   m-0 row border-botBlue justify-content-center" >
                        <p class="col-12 p-0 m-0 text-center" id="textFilterPosts">Projecto  -  cliente</p>
                        <a class="col-4 text-decoration-none text-center p-0 m-0" id="btnFilters" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-chevron-down"></i></a>
                        <div class="collapse col-12" id="collapseExample">
                            <div class="row p-0">
                                <button class="btn-sm rounded-pill button-actions  bg-white py-0 col-2 mt-2" onclick="filter()">Filter</button>
                                <div class="input-group  bg-transparent col-5">
                                    <select class="custom-select border-0" id="clientSelect">
                                    <option selected class="clientSelectOption" value="All">All</option>)
                                        <option v-for="(client, index) in clients" :key="'client'+index" :value="client.id" class="clientSelectOption">{{client.client_name}}</option>
                                    </select>
                                </div>
                                <div class="input-group   bg-transparent col-5">
                                    <select class="custom-select border-0" id="projectSelect" >
                                        <option selected value="All">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 scroll-post scrollable  " id="divPosts">
                    </div>
                    <div class="col-12 row justify-content-between p-0 m-0 pt-1">
                        <div class="col-9">
                        </div>
                        <button class="btn-sm rounded-pill button-actions col-3 bg-white py-0 " data-toggle="modal" data-target="#modalPosts">+ Post</button>
                    </div>
                </div>

                <!-- Sección (Tasks/Calendar) -->
                <div class="col-5 justify-content-between row  shadow rounded-lg d-inline border p-1 pt-2 bg-white Tasks" >
                    <div class="col-12 scrollable " id="tasksBox">
                    </div>
                    <div class="col-12 row justify-content-around p-0 m-0 mt-1">
                        <button class="btn-sm rounded-pill button-actions col-5 bg-white py-0" data-toggle="modal" data-target="#modalEvent">+ Event</button>
                        <button class="btn-sm rounded-pill button-actions col-5 bg-white py-0" data-toggle="modal" data-target="#modalTasks">+ Task</button>
                    </div>
                </div>
            </div>
            <!-- FIN Segunda Sección (Tasks/Calendar) -->
        </main>

<!-- The Modal -->
<div id="modalImgExpand" class="modalimg" onclick="closeModalImgExpanded()">
    <!-- The Close Button -->
    <!-- Modal Content (The Image) -->
    <img class="modalimg-content" id="imgExpanded">
    <!-- Modal Caption (Image Text) -->
  </div>

  <!-- The Modal -->
<div id="modalImgExpandMulti" class="modalimg" onclick="closeModalImgExpandedMulti()">
    <!-- The Close Button -->
    <!-- Modal Content (The Image) -->
    <img class="modalimg-content" id="imgExpandedMulti">
    <!-- Modal Caption (Image Text) -->
  </div>

  <!-- Modal -->
<div class="modal fade" id="pleaseWaitDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h1>Processing...</h1>
        </div>
        <div class="modal-body">
          <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 1%" id="statusPostUpload">
              <span class="sr-only">40% Complete (success)</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    </div>
</template>

<script>

export default {
    props: ["clients"]
}
</script>

<style>

</style>
