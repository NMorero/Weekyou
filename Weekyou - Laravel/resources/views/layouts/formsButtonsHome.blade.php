<!-- Modal -->
<div class="modal fade" id="modalTasks" tabindex="-1" role="dialog" aria-labelledby="modalTasksLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="modalTasksLabel" >New Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" class="row" id="TaskBtnForm" >
                <div class="form-group col-12" id="commentTaskBtn">
                  <label for="TaskBtnMessage1" class="text-muted">Tasks</label>
                  <input type="text" name="TaskBtnMessage1" id="TaskBtnMessage1" class="form-control" placeholder="Task 1" required>


                </div>
                <input type="number" name="commentsCant" id="commentsCant" value="1" hidden>
                <div class="form-group col-12 justify-content-center row">
                    <button class="btn btn-primary col-6" onclick="addcommentTask()">Add task</button>
                </div>
                <input type="text" name="TaskBtnStatusSelect" id="TaskBtnStatusSelect" hidden>


                <div class="form-group col-8" id="usersSelectBox">
                    <label for="TaskBtnUserSelect" class="text-muted">Users</label>
                    <select name="TaskBtnUserSelect1" id="TaskBtnUserSelect0" class="custom-select" required>
                        <option value="null">Select...</option>
                    </select>
                </div>
                <div class="form-group col-12 justify-content-center row">
                    <button class="btn btn-primary col-6" onclick="addUserBtn()">Add user</button>
                </div>
                <input type="number" name="TaskBtnUserCant" id="TaskBtnUserCant" value="0" hidden>


                <div class="form-group col-6">
                    <label for="TaskBtnEndDate" class="text-muted">End Date</label>
                    <input type="date" id="TaskBtnEndDate" class="form-control" name="TaskBtnEndDate" required>
                </div>

                <div class="form-group col-6">
                    <label for="TaskBtnClientSelect" class="text-muted">Client</label>
                    <select name="TaskBtnClientSelect" id="TaskBtnClientSelect" class="custom-select" onchange="getProjectsByClient('Task')" required>
                        <option value="null">Select...</option>
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}" > {{$client->client_name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-6" >
                    <label for="TaskBtnProjectSelect" class="text-muted">Project</label>
                    <select name="TaskBtnProjectSelect" id="TaskBtnProjectSelect" class="custom-select" onchange="getViewsByProject('Task')" required>

                    </select>
                </div>

                <div class="form-group col-6" >
                    <label for="TaskBtnViewSelect" class="text-muted">View</label>
                    <select name="TaskBtnViewSelect" id="TaskBtnViewSelect" class="custom-select" >

                    </select>
                </div>


                <div class="modal-footer col-12">
                  <button type="button" class="btn btn-secondary" id="closeTask" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" id="submitTask">Done</button>
                </div>
              </form>

        </div>

      </div>
    </div>
  </div>

  {{-- form deliveries --}}
  <div class="modal fade" id="modalDelivery" tabindex="-1" role="dialog" aria-labelledby="modalDeliveryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="modalDeliveryLabel">New Delivery</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" class="row" id="DeliveryBtnForm">
                <div class="form-group col-12">
                    <label for="DeliveryBtnMessage" class="text-muted">Comment</label>
                    <textarea name="DeliveryBtnMessage" id="DeliveryBtnMessage" class="form-control" cols="20" rows="3" ></textarea>
                </div>
                <div class="form-group col-5">
                    <label for="DeliveryBtnClientSelect" class="text-muted">Client</label>
                    <select name="DeliveryBtnClientSelect" id="DeliveryBtnClientSelect" class="custom-select" onchange="getProjectsByClient('Delivery')" required>
                        <option value="null">Select...</option>
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}" > {{$client->client_name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-5">
                    <label for="DeliveryBtnProjectSelect" class="text-muted">Project</label>
                    <select name="DeliveryBtnProjectSelect" id="DeliveryBtnProjectSelect" class="custom-select" onchange="getViewsByProject('Delivery')" required>

                    </select>
                </div>
                <div class="form-group col-5">
                    <label for="DeliveryBtnViewSelect" class="text-muted">View</label>
                    <select name="DeliveryBtnViewSelect" id="DeliveryBtnViewSelect" class="custom-select">

                    </select>
                </div>
                <div class="form-group col-5">
                    <label for="DeliveryBtnTemplateSelect" class="text-muted">Template</label>
                    <select name="DeliveryBtnTemplateSelect" id="DeliveryBtnTemplateSelect" class="custom-select" required>

                    </select>
                </div>

                <div class="modal-footer col-12">
                  <button type="button" class="btn btn-secondary" id="closeDelivery" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" id="submitDelivery">Done</button>
                </div>

            </form>
        </div>

      </div>
    </div>
  </div>

  {{-- form Feedbacks --}}

  <div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="modalFeedbackLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="modalFeedbackLabel" >New Feedback</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" >Done</button>
        </div>
      </div>
    </div>
  </div>

  {{-- form events --}}

  <div class="modal fade" id="modalEvent" tabindex="-1" role="dialog" aria-labelledby="modalEventLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="modalEventLabel">New Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" class="row" id="EventBtnForm">
                <div class="form-group col-12">
                    <label for="EventBtnMessage" class="text-muted">Message</label>
                    <textarea name="EventBtnMessage" id="EventBtnMessage" class="form-control" cols="20" rows="3" required></textarea>
                </div>
                <div class="form-group col-5">
                    <label for="EventBtnClientSelect" class="text-muted">Client</label>
                    <select name="EventBtnClientSelect" id="EventBtnClientSelect" class="custom-select" onchange="getProjectsByClient('Event')">
                        <option value="">Select...</option>
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}"> {{$client->client_name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-5">
                    <label for="EventBtnProjectSelect" class="text-muted">Project</label>
                    <select name="EventBtnProjectSelect" id="EventBtnProjectSelect" class="custom-select" onchange="getViewsByProject('Event')">

                    </select>
                </div>
                <div class="form-group col-5">
                    <label for="EventBtnViewSelect" class="text-muted">View</label>
                    <select name="EventBtnViewSelect" id="EventBtnViewSelect" class="custom-select">

                    </select>
                </div>
                <div class="form-group col-5">
                    <label for="EventBtnEndDate" class="text-muted">End date</label>
                    <input type="date" name="EventBtnEndDate" id="EventBtnEndDate" class="form-control" required>
                </div>
                <div class="modal-footer col-12">
                  <button type="button" class="btn btn-secondary" id="closeEvent" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" id="submitEvent">Done</button>
                </div>
            </form>
        </div>

      </div>
    </div>
  </div>
 {{-- form posts --}}

 <div class="modal fade" id="modalPosts" tabindex="-1" role="dialog" aria-labelledby="modalPostsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="modalPostsLabel">New Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" class="row justify-content-between p-2" id="postBtnForm">
                @csrf
                <div class="form-group col-12">
                    <label for="PostBtnTitle" class="text-muted">Title</label>
                    <input type="text" name="PostBtnTitle" id="PostBtnTitle" class="form-control" required>
                </div>
                <div class="form-group col-12">
                    <label for="PostBtnMessage" class="text-muted">Message</label>
                    <textarea name="PostBtnMessage" id="PostBtnMessage" class="form-control" cols="20" rows="3" required></textarea>
                </div>
                <div class="form-group col-4">
                    <label for="PostBtnClientSelect" class="text-muted">Client</label>
                    <select name="PostBtnClientSelect" id="PostBtnClientSelect" class="custom-select" onchange="getProjectsByClient('Post')" required>
                        <option value="null">Select...</option>
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}" > {{$client->client_name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="PostBtnProjectSelect" class="text-muted">Project</label>
                    <select name="PostBtnProjectSelect" id="PostBtnProjectSelect" class="custom-select" onchange="getViewsByProject('Post')" required>

                    </select>
                </div>
                <div class="form-group col-4">
                    <label for="PostBtnViewSelect"class="text-muted">View</label>
                    <select name="PostBtnViewSelect" id="PostBtnViewSelect" class="custom-select">

                    </select>
                </div>

                <div id="filePostModal" class="form-group col-12">
                  <div class="custom-file col-12 px-5">
                    <input type="file" class="custom-file-input" name="PostBtnFile[]" id="PostBtnFile" multiple>
                    <label class="custom-file-label text-muted" for="PostBtnFile">Choose files</label>
                  </div>
                </div>





                <div class="modal-footer col-12">
                    <button type="button" class="btn btn-secondary" id="closePostBtn" data-dismiss="modal" onclick="resteForm()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitPost">Done</button>
                  </div>
            </form>
        </div>

      </div>
    </div>
  </div>

   {{-- form reminder --}}

