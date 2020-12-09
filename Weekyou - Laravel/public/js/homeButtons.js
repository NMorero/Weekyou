
function resteForm(){
    document.getElementById("postBtnForm").reset();
}

$(function () {
    var pleaseWait = $('#pleaseWaitDialog');

    showPleaseWait = function() {
        pleaseWait.modal('show');
    };

    hidePleaseWait = function () {
        pleaseWait.modal('hide');
    };

    hidePleaseWait();
});

$("#postBtnForm").on("submit", function(e) {
    document.getElementById('submitPost').disabled = true;
    e.preventDefault();
    console.log("si");
    var f = $(this);
    var formData = new FormData(document.getElementById("postBtnForm"));
    console.log("data:" + formData);
    //formData.append(f.attr("name"), $(this)[0].files[0]);
    showPleaseWait();
    $.ajax({
        url: "/addPost",
        type: "post",
        dataType: "html",
        data: formData,
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){
                myXhr.upload.addEventListener('progress',progress, false);
            }
            return myXhr;
        },
        cache: false,
        contentType: false,

        processData: false
    })
    .done(function(res) {
        socket.emit('postUpload', {message:'Post Uploaded'});
        console.log(res);
        hidePleaseWait();
        document.getElementById("postBtnForm").reset();
        getPosts();
        document.getElementById('PostBtnFile').value = "";
        document.getElementById('submitPost').disabled = false;
        $("#closePostBtn").click();
    })
    .fail(function() {
        hidePleaseWait();
        alert( "Error al subir el post" );
        document.getElementById('submitPost').disabled = false;
      });

});

function progress(e){
    if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;
        var Percentage = (current * 100)/max;
        $("#statusPostUpload").attr('aria-valuenow', Percentage).css('width', Percentage);
        if(Percentage >= 100)
        {
            hidePleaseWait();
        }
    }
 }


var users = "";

getUsers();

userSelect = document.getElementById("TaskBtnUserSelect0");
users.map(function(user) {
    const templateLiteral = `
    <option value="${user.id}">${user.username}</option>
    `;

    userSelect.innerHTML = userSelect.innerHTML.concat(templateLiteral);
});

function getUsers() {
    $.ajax({
        url: "/getUsers",
        type: "get",
        async: false,
        success: function(data) {
            users = Object.values(data);
        }
    });

}

function getProjectsByClient(button) {
    let client = document.getElementById(button + "BtnClientSelect").value;
    $.ajax({
        url: "/getProjectsByClient/" + client,
        type: "get",
        async: false,
        success: function(data) {
            projects = Object.values(data);
            var projectSelect = document.getElementById(
                button + "BtnProjectSelect"
            );
            projectSelect.innerHTML = `
            <option value="">Select..</option>
            `;
            projects.map(function(project) {
                const templateLiteral = `
                <option value="${project.id}">${project.project_name}</option>
                `;

                projectSelect.innerHTML = projectSelect.innerHTML.concat(
                    templateLiteral
                );
            });
        }
    });
}

function getViewsByProject(button) {
    let project = document.getElementById(button + "BtnProjectSelect").value;

    if (document.getElementById(button + "BtnViewSelect")) {
        $.ajax({
            url: "/getViewsByProject/" + project,
            type: "get",
            async: false,
            success: function(data) {
                views = Object.values(data);
                var ViewSelect = document.getElementById(
                    button + "BtnViewSelect"
                );
                ViewSelect.innerHTML = `
              <option value="">Select..</option>
              `;
                views.map(function(view) {
                    const templateLiteral = `
                  <option value="${view.id}">${view.id}</option>
                  `;

                    ViewSelect.innerHTML = ViewSelect.innerHTML.concat(
                        templateLiteral
                    );
                });
            }
        });
    }

    if (document.getElementById(button + "BtnTemplateSelect")) {
        $.ajax({
            url: "/getTemplates",
            type: "get",
            async: false,
            success: function(data) {
                templates = Object.values(data);
                var TemplateSelect = document.getElementById(
                    button + "BtnTemplateSelect"
                );
                TemplateSelect.innerHTML = `
              <option value="">Select..</option>
              `;
                templates.map(function(template) {
                    const templateLiteral = `
                  <option value="${template.id}">${template.template_name}</option>
                  `;

                    TemplateSelect.innerHTML = TemplateSelect.innerHTML.concat(
                        templateLiteral
                    );
                });
            }
        });
    }
}

$("#TaskBtnForm").submit(function(e) {
    e.preventDefault();
    saveButton("Task");
});

$("#DeliveryBtnForm").submit(function(e) {
    e.preventDefault();
    saveButton("Delivery");
});
$("#EventBtnForm").submit(function(e) {
    e.preventDefault();
    saveButton("Event");
});

$("#closeTask").click(function(e){
    document.getElementById('commentTaskBtn').innerHTML = ` <label for="TaskBtnMessage1" class="text-muted">Tasks</label>
        <input type="text" name="TaskBtnMessage1" id="TaskBtnMessage1" class="form-control" placeholder="Task 1" required>`
        document.getElementById('commentsCant').setAttribute('value', 1);
        var userBox = document.getElementById('usersSelectBox');

        var cantInp = document.getElementById('TaskBtnUserCant').setAttribute('value', 0);
        userBox.innerHTML =`
        <select name="TaskBtnUserSelect0" id="TaskBtnUserSelect0" class="custom-select" required>
                        <option value="null">Select...</option>
                    </select>
                    `;
                    $.ajax({
                        url: "/getUsers",
                        type: "get",
                        async: false,
                        success: function(data) {
                            users = Object.values(data);
                            var select0 = document.getElementById('TaskBtnUserSelect0');
                            users.map(function(user) {
                                select0.innerHTML = select0.innerHTML.concat(`<option value="${user.id}">${user.username}</option>`);
                            });
                        }
                    });
    });

function saveButton(button) {
    document.getElementById('submit'+button).disabled = true;
    console.log("si");
    let formData = {
        status: null,
        user: null,
        client: null,
        project: null,
        view: null,
        message: null,
        end_date: null,
        template: null,
        developer: null,
        title: null,
        file: null
    };

    if (button == "Task") {
        let array = [];
        let users = [];
        let cantComments = document.getElementById("commentsCant").value;
        for (var i = 1; i <= cantComments; i++) {
            let comment = document.getElementById("TaskBtnMessage" + i);
            array.push(comment.value);
        }
        var cant = document.getElementById('TaskBtnUserCant').value
        for(var i = 0; i <= cant; i++){
            var user = document.getElementById('TaskBtnUserSelect'+i).value
            users.push(user);
        }

        formData['UsersTasks'] = users;

        document.getElementById('commentTaskBtn').innerHTML = ` <label for="TaskBtnMessage1" class="text-muted">Tasks</label>
        <input type="text" name="TaskBtnMessage1" id="TaskBtnMessage1" class="form-control" placeholder="Task 1" required>`
        document.getElementById('commentsCant').setAttribute('value', 1);

        formData["message"] = array.join();
        console.log(array.join());
    }

    if (document.getElementById(button + "BtnStatusSelect")) {
        var status = document.getElementById(button + "BtnStatusSelect").value;
        formData["status"] = status;
        // console.log('Status: '+status);
    }
    if (document.getElementById(button + "BtnUserSelect")) {
        var user = document.getElementById(button + "BtnUserSelect").value;
        formData["user"] = user;
        //console.log('User: ' + user);
    }

    if (
        document.getElementById(button + "BtnClientSelect") &&
        document.getElementById(button + "BtnClientSelect").value != "null"
    ) {
        var client = document.getElementById(button + "BtnClientSelect").value;
        formData["client"] = client;
        //console.log('Client: ' + client);
    }

    if (
        document.getElementById(button + "BtnProjectSelect") &&
        document.getElementById(button + "BtnProjectSelect").value != "null"
    ) {
        var project = document.getElementById(button + "BtnProjectSelect")
            .value;
        formData["project"] = project;
        //console.log('Project: ' + project);
    }

    if (document.getElementById(button + "BtnViewSelect")) {
        var view = document.getElementById(button + "BtnViewSelect").value;
        if (view != null) {
            formData["view"] = view;
            //console.log('View: ' + view);
        }
    }

    if (document.getElementById(button + "BtnMessage") && button !== "Task") {
        var message = document.getElementById(button + "BtnMessage").value;
        formData["message"] = message;
        //console.log('Message: ' + message);
    }

    if (document.getElementById(button + "BtnEndDate")) {
        var endDate = document.getElementById(button + "BtnEndDate").value;
        formData["end_date"] = endDate;
        //console.log('End date: ' + endDate);
    }

    if (document.getElementById(button + "BtnTemplateSelect")) {
        var template = document.getElementById(button + "BtnTemplateSelect")
            .value;
        formData["template"] = template;
        //console.log('Template: ' + template);
    }

    if (document.getElementById(button + "BtnDeveloperSelect")) {
        var developer = document.getElementById(button + "BtnDeveloperSelect")
            .value;
        formData["developer"] = developer;
        //console.log('Developer: ' + developer);
    }

    if (document.getElementById(button + "BtnTitle")) {
        var title = document.getElementById(button + "BtnTitle").value;
        formData["title"] = title;
        //console.log('Title: ' + title);
    }

    if (document.getElementById(button + "BtnFile")) {
        var file = document.getElementById(button + "BtnFile").value;
        formData["file"] = file;
        //console.log('File: ' + file);
    }
    formData = JSON.stringify(formData);
    console.log(formData);

    let route = "/add" + button + "/" + formData;
    console.log(route);
    fetch(route)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            if(button == 'Task'){
                socket.emit('taskUpload', {message:'Task Uploaded'});
            }
            document.getElementById(button + "BtnForm").reset();
            console.log(data.status);
            getPosts();
            getTasks();

            $("#close" + button).click();
        })
        .catch(function(error) {
            console.log(error);
        });
        document.getElementById('submit'+button).disabled = false;
}
