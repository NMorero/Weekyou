var scrolled = false;
getPosts();
getTasks(scrolled);

function scroll(){
    var elmnt = document.getElementById("actualAgenda");
//console.log('Dia:'+elmnt);
elmnt.scrollIntoView();
}



var socket = io.connect('http://34.227.147.249:4200');
        socket.on('connect', function(data) {
            console.log('Connected to websocket');
        });
        socket.on('postUpload', function(data) {
            getPosts();
            //console.log()
        });
        socket.on('taskUpload', function(data) {
            getTasks();
        });
        socket.on('postDelete', function(data) {
            getPosts();
        });
let cantComments = 1;
function addcommentTask() {
    var comments = [];
    let commentDiv = document.getElementById("commentTaskBtn");
    let cantInp = document.getElementById("commentsCant");

    for(var i = 1; i <= cantInp.value; i++){
        let prevComment = document.getElementById("TaskBtnMessage" + i);
        comments.push({
            name: prevComment.name,
            value: prevComment.value,
            placeholder: prevComment.placeholder,
            id: prevComment.id
        });
    }
    //console.log(comments);

    comments.forEach(comm => {
        let input = document.getElementById(comm.id);
        input.setAttribute("value", comm.value);
        input.setAttribute("name", comm.name);
        input.setAttribute("placeholder", comm.placeholder);
    });
    cantComments++;


    let template1 = `<input type="text" name="TaskBtnMessage${cantComments}" id="TaskBtnMessage${cantComments}" class="form-control" placeholder="Task ${cantComments}" required>`;
    commentDiv.innerHTML = commentDiv.innerHTML.concat(template1);
    cantInp.setAttribute("value", cantComments);
}

$("#clientSelect").change(function() {
    //console.log("si");
    var clientoption = document.getElementById("clientSelect").value;
    //console.log("value client: " + clientoption);

    if (clientoption != "All") {
        fetch("getProjectsByClient/" + clientoption)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                //console.log(data);
                document.getElementById("projectSelect").disabled = false;
                var selectProjects = document.getElementById("projectSelect");
                selectProjects.innerHTML = `<option selected onclick="projectSelect()" value="All">All</option>`;
                data.map(function(project) {
                    const templateLiteral = `
                <option value="${project.id}" > ${project.project_name} </option>
                `;

                    selectProjects.innerHTML = selectProjects.innerHTML.concat(
                        templateLiteral
                    );
                });
            })
            .catch(function(error) {
                console.log(error);
            });
    } else {
        var selectProject = document.getElementById("projectSelect");
        selectProject.innerHTML = `<option selected  value="All">All</option>`;
        var selectView = document.getElementById("viewSelect");
        selectView.innerHTML = `<option selected  value="All">All</option>`;
        document.getElementById("projectSelect").value = "All";

    }
});

function filter(){
    document.getElementById('btnFilters').click();
    getPosts();
}
function getPosts() {

    var pFiltersPost = document.getElementById("textFilterPosts");
    var client = document.getElementById("clientSelect");
    var project = document.getElementById("projectSelect");
    var clientText = $("#clientSelect option:selected").html();
    var projectText = $("#projectSelect option:selected").html();
    pFiltersPost.innerHTML = `${clientText} - ${projectText}`;


    var view = "All";
    var route = "/getPosts/" + client.value + "/" + project.value + "/" + view;
    //console.log(route);
    fetch(route)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            //console.log(data);
            data = Object.values(data);
            data.sort();
            data.reverse();
            var divPosts = document.getElementById("divPosts");
            divPosts.innerHTML = "";
            var iImages = 1;
            data.map(function(post) {
                if (post.type == "post") {
                    if (post.image != null) {
                        var propor = post.image.width / post.image.height;
                        if(propor >= 1.33){
                            const templateLiteral = `
                    <div class="row border-botBlue my-2 py-2">
                    <p class=" col-2 text-dark" onclick="dotsMenuOpen(${post.id})" >
                    <i class="fas fa-ellipsis-h"></i>
                    </p>
                    <div class="rounded bg-white mt-3 ml-2 infoHover border p-2 dotsMenu" id="div${post.id}" style="display:none;position:absolute;z-index:400">
                        <button class="btn border-bottom" onclick="deletePost(${post.id})">Delete</button><br>
                        <button class="btn" onclick="dotsMenuClose(${post.id})">Close</button>
                    </div>
                    <p class=" col-10 text-right postInfo mb-0">${post.client} - ${post.project} - ${post.user_name} - ${post.date} - ${post.time}</p>
                    <p class="col-12 postMessage mt-1" style="white-space: pre-line"><b>${post.title}:</b> ${post.message}</p>
                    <img src="${post.image}" class="postImage" alt="" onclick="openModalImg(${post.id})" id="postImg${post.id}">


                </div>
                    `;
                        divPosts.innerHTML = divPosts.innerHTML.concat(
                            templateLiteral
                        );
                        }else if(propor < 1.33 && propor >= 1){
                            const templateLiteral = `
                    <div class="row border-botBlue my-2 py-2">
                    <p class=" col-2 text-dark" onclick="dotsMenuOpen(${post.id})" >
                    <i class="fas fa-ellipsis-h"></i>
                    </p>
                    <div class="rounded bg-white mt-3 ml-2 infoHover border p-2 dotsMenu" id="div${post.id}" style="display:none;position:absolute;z-index:400">
                        <button class="btn border-bottom" onclick="deletePost(${post.id})">Delete</button><br>
                        <button class="btn" onclick="dotsMenuClose(${post.id})">Close</button>
                    </div>
                    <p class=" col-10 text-right postInfo mb-0">${post.client} - ${post.project} - ${post.user_name} - ${post.date} - ${post.time}</p>
                    <p class="col-12 postMessage mt-1" style="white-space: pre-line"><b>${post.title}:</b> ${post.message}</p>

                    <div class="col-12 px-3"><img src="${post.image}" class="postImage" alt=""  onclick="openModalImg(${post.id})" id="postImg${post.id}"></div>

                </div>
                    `;
                        divPosts.innerHTML = divPosts.innerHTML.concat(
                            templateLiteral
                        );
                        }else{
                            const templateLiteral = `
                    <div class="row border-botBlue my-2 py-2">
                    <p class=" col-2 text-dark" onclick="dotsMenuOpen(${post.id})" >
                    <i class="fas fa-ellipsis-h"></i>
                    </p>
                    <div class="rounded bg-white mt-3 ml-2 infoHover border p-2 dotsMenu" id="div${post.id}" style="display:none;position:absolute;z-index:400">
                        <button class="btn border-bottom" onclick="deletePost(${post.id})">Delete</button><br>
                        <button class="btn" onclick="dotsMenuClose(${post.id})">Close</button>
                    </div>
                    <p class=" col-10 text-right postInfo mb-0">${post.client} - ${post.project} - ${post.user_name} - ${post.date} - ${post.time}</p>
                    <p class="col-12 postMessage mt-1" style="white-space: pre-line"><b>${post.title}:</b> ${post.message}</p>

                    <div class="col-12 px-5 py-0"><img src="${post.image}" class="postImage"  onclick="openModalImg(${post.id})" id="postImg${post.id}"></div>

                </div>
                    `;
                        divPosts.innerHTML = divPosts.innerHTML.concat(
                            templateLiteral
                        );
                        }
                    }else if(post.images !== null){
                        var templateLiteral2 = `
                            <div class="row border-botBlue my-2 py-2">
                                <p class=" col-2 text-dark" onclick="dotsMenuOpen(${post.id})" >
                                <i class="fas fa-ellipsis-h"></i>
                                </p>
                                <div class="rounded bg-white mt-3 ml-2 infoHover border p-2 dotsMenu" id="div${post.id}" style="display:none;position:absolute;z-index:400">
                                    <button class="btn border-bottom" onclick="deletePost(${post.id})">Delete</button><br>
                                    <button class="btn" onclick="dotsMenuClose(${post.id})">Close</button>
                                </div>
                                <p class=" col-10 text-right postInfo mb-0">${post.client} - ${post.project} - ${post.user_name} - ${post.date} - ${post.time}</p>
                                <p class="col-12 postMessage mt-1" style="white-space: pre-line"><b>${post.title}:</b> ${post.message}</p>
                        `;
                        var postImages = JSON.parse(post.images);

                        for(var key in postImages){
                            //console.log(postImages[key]);
                            var propor = postImages[key].width / postImages[key].height;
                            iImages++;
                            if(propor >= 1.33){
                                imageTemplate = `
                                <img src="${postImages[key].image}" class="postImage" alt="" onclick="openModalImgMulti(${iImages})" id="postMultiImg${iImages}">
                                </div>
                                `;
                                templateLiteral2 = templateLiteral2 + imageTemplate;
                            }else if(propor < 1.33 && propor >= 1){
                                imageTemplate = `
                                <div class="col-12 px-3"><img src="${postImages[key].image}" class="postImage" alt=""  onclick="openModalImgMulti(${iImages})" id="postMultiImg${iImages}"></div>
                                </div>
                                `;
                                templateLiteral2 = templateLiteral2 + imageTemplate;
                            }else{
                                imageTemplate = `
                                <div class="col-12 px-5 py-0"><img src="${postImages[key].image}" class="postImage"  onclick="openModalImgMulti(${iImages})" id="postMultiImg${iImages}"></div>
                                </div>
                                `;
                                templateLiteral2 = templateLiteral2 + imageTemplate;
                            }
                        }
                        divPosts.innerHTML = divPosts.innerHTML.concat(templateLiteral2);
                    }else {
                        const templateLiteral = `
                    <div class="row border-botBlue my-2 py-2">
                    <p class=" col-2 text-dark" onclick="dotsMenuOpen(${post.id})" >
                    <i class="fas fa-ellipsis-h"></i>
                    </p>
                    <div class="rounded bg-white mt-3 ml-2 infoHover border p-2 dotsMenu" id="div${post.id}" style="display:none;position:absolute;z-index:400">
                        <button class="btn border-bottom" onclick="deletePost(${post.id})">Delete</button><br>
                        <button class="btn" onclick="dotsMenuClose(${post.id})">Close</button>
                    </div>
                    <p class=" col-10 text-right postInfo mb-0">${post.client} - ${post.project} - ${post.user_name} - ${post.date} - ${post.time}</p>
                    <p class="col-12 postMessage mt-1" style="white-space: pre-line"><b>${post.title}:</b> ${post.message}</p>


                </div>
                    `;
                        divPosts.innerHTML = divPosts.innerHTML.concat(
                            templateLiteral
                        );
                    }
                } else if (post.type == "feedbackCreate") {
                    const templateLiteral = `

                    <div class="row mb-0">
                        <p class=" col-2 text-dark" onclick="dotsMenuOpen(${post.id})" >
                        <i class="fas fa-ellipsis-h"></i>
                        </p>
                        <p class=" col-10 text-right postInfo mb-0 pt-1">${post.client} - ${post.project} - ${post.user_name} - ${post.date} - ${post.time}</p>
                        <div class="rounded bg-white mt-3 ml-2 infoHover border p-2 dotsMenu" id="div${post.id}" style="display:none;position:absolute;z-index:400">
                            <button class="btn border-bottom" onclick="deleteFeedback(${post.feedback_id})">Delete</button><br>
                            <button class="btn" onclick="dotsMenuClose(${post.id})">Close</button>
                        </div>
                    </div>
                    <a href="/Feedback/Edit/${post.feedback_id}" class="row border-botBlue p-1 text-decoration-none text-dark justify-content-between my-2 py-2">

                        <p class="col-12 postMessage mt-1" style="white-space: pre-line"><b>${post.title}:</b> ${post.message}</p>
                        </ul>

                    `;

                    var comments = JSON.parse(post.feedback.message);
                    var templatelit3 = ``;
                    comments.map(function(comm) {
                        if (comm.status == "done") {
                            var temp = `<li><strike>
                            ${comm.comment}
                            </strike>
                        </li>`;
                        } else {
                            var temp = `<li>
                            ${comm.comment}
                        </li>`;
                        }

                        templatelit3 = templatelit3 + temp;
                    });
                    const templatelit2 = `
                    </ul>
                    <img src="${post.image}" class="postImage" alt="">
                </a>`;
                    const template =
                        templateLiteral + templatelit3 + templatelit2;
                    divPosts.innerHTML = divPosts.innerHTML.concat(template);
                } else {
                    const templateLiteral = `
                    <div class="row mb-0">
                        <p class=" col-2 text-dark" onclick="dotsMenuOpen(${post.id})" >
                        <i class="fas fa-ellipsis-h"></i>
                        </p>
                        <p class=" col-10 text-right postInfo mb-0 pt-1">${post.client} - ${post.project} - ${post.user_name} - ${post.date} - ${post.time}</p>
                        <div class="rounded bg-white mt-3 ml-2 infoHover border p-2 dotsMenu" id="div${post.id}" style="display:none;position:absolute;z-index:400">
                            <button class="btn border-bottom" onclick="deleteFeedback(${post.feedback_id})">Delete</button><br>
                            <button class="btn" onclick="dotsMenuClose(${post.id})">Close</button>
                        </div>
                    </div>
                    <a href="/Feedback/Edit/${post.feedback_id}" class="row border-botBlue p-1 text-decoration-none text-dark my-2 py-2">

                        <p class="col-12 postMessage mt-1" style="white-space: pre-line"><b>${post.title}:</b> ${post.message}</p>
                        <ul class="col-9">

                    `;

                    var comments = JSON.parse(post.feedback.message);
                    var templatelit3 = ``;
                    comments.map(function(comm) {
                        if (comm.status == "done") {
                            var temp = `<li><strike>
                            ${comm.comment}
                            </strike>
                        </li>`;
                        } else {
                            var temp = `<li>
                            ${comm.comment}
                        </li>`;
                        }

                        templatelit3 = templatelit3 + temp;
                    });
                    const templatelit2 = `
                    </ul>
                    <img class="col-3 mb-1" src="${post.image}"  alt="" height"50" width="60">
                </a>`;
                    const template =
                        templateLiteral + templatelit3 + templatelit2;
                    divPosts.innerHTML = divPosts.innerHTML.concat(template);
                }
            });
        })
        .catch(function(error) {
            console.log(error);
        });
}


function deletePost(id){

        fetch("/deletePost/" + id)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                getPosts();
            })
            .catch(function(error) {
                console.log(error);
            });
    }


    function deleteFeedback(id){
        fetch("/deleteFeedback/" + id)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            getPosts();
        })
        .catch(function(error) {
            console.log(error);
        });

    }


function getTasks(scrolled) {
    fetch("/getTasks")
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            data = Object.values(data);
            //console.log(data);
            var i = 0;
            var tasksBox = document.getElementById("tasksBox");
            tasksBox.innerHTML = "";
            data.map(function(tasks) {
                i++;
                if(typeof tasks.today !== 'undefined' && tasks.today == 'si'){
                    //console.log(tasks);
                    const templateLiteral = `
                        <div class="col-12 row  mb-1 m-0 p-0 border-bottom" >
                            <h6 class="col-12 text-right mb-2" id="actualAgenda">${tasks.day}</h6>
                            <div class="col-12 p-0 m-0" id="tasks${i}">
                            </div>
                        </div>
                    `;
                tasksBox.innerHTML = tasksBox.innerHTML.concat(templateLiteral);
                }else{
                    const templateLiteral = `
                        <div class="col-12 row  mb-1 m-0 p-0 border-bottom">
                            <h6 class="col-12 text-right mb-2">${tasks.day}</h6>
                            <div class="col-12 p-0 m-0" id="tasks${i}">
                            </div>
                        </div>
                    `;
                tasksBox.innerHTML = tasksBox.innerHTML.concat(templateLiteral);
                }

                var userLoged = document.getElementById('userLoged').value;
                var rol = document.getElementById('rolLoged').value;
                tasks.projects.map(function(task) {
                    if(userLoged == task.created_by || rol == 1){
                        let tasksBox2 = document.getElementById("tasks" + i);

                    const templateLiteral = `
                        <div class="row m-0 p-0"><ul class="p-0 m-0" style="list-style-type: none;">`;
                    let comments = JSON.parse(task.message);
                    let templatelit2 = ``;
                    comments.map(function(comm) {
                        if (comm.status == 1) {
                            let temp = `<li class=" mb-2 m-0 p-0">
                        <div class="form-check form-check-inline m-0 p-0">
                        <input class="form-check-input" type="checkbox" id="task${task.id}Check${comm.id}" value="option1" onclick="test(${task.id}, ${comm.id})"><span>${comm.data}</span>

                      </div>
                      <br>
                            <span class="postInfo">${task.client.client_name} - ${task.project.project_name} - ${task.user.username} <a class="ml-1" onclick="deleteTask(${task.id} , ${comm.id})" style="cursor:pointer">X</a></span>
                        </li>
                        `;
                            templatelit2 = templatelit2 + temp;
                        } else {
                            let temp = `<li class=" mb-2 m-0 p-0" >
                        <div class="form-check form-check-inline p-0 m-0">
                        <input class="form-check-input" type="checkbox" id="task${task.id}Check${comm.id}" value="option1" onclick="test(${task.id}, ${comm.id})" checked><span><strike>${comm.data} </strike></span>

                      </div>
                      <br>
                      <span class="postInfo"> ${task.client.client_name} - ${task.project.project_name} - ${task.user.username}<a class="ml-1" onclick="deleteTask(${task.id}, ${comm.id})" style="cursor:pointer">X</a></span>
                        </li>`;
                            templatelit2 = templatelit2 + temp;
                        }
                    });

                    if (task.client && task.client.length) {
                        const templatelit3 = `</ul><p class="taskFooter text-right col-12">${task.client.client_name} // ${task.project.project_name} // ${task.user.username}</p>
                        </div>
                        `;
                        tasksBox2.innerHTML = tasksBox2.innerHTML.concat(
                            templateLiteral + templatelit2 + templatelit3
                        );
                    } else {
                        tasksBox2.innerHTML = tasksBox2.innerHTML.concat(
                            templateLiteral + templatelit2
                        );
                    }
                    }else{
                        let tasksBox2 = document.getElementById("tasks" + i);

                    const templateLiteral = `
                        <div class="row m-0 p-0"><ul class="p-0 m-0" style="list-style-type: none;">`;
                    let comments = JSON.parse(task.message);
                    let templatelit2 = ``;
                    comments.map(function(comm) {
                        if (comm.status == 1) {
                            let temp = `<li class=" mb-2 m-0 p-0">
                        <div class="form-check form-check-inline m-0 p-0">
                        <input class="form-check-input" type="checkbox" id="task${task.id}Check${comm.id}" value="option1" onclick="test(${task.id}, ${comm.id})"><span>${comm.data} - ${task.user.username} </span>

                      </div>
                      <br>
                      <span class="postInfo"> ${task.client.client_name} - ${task.project.project_name} - ${task.user.username} </span>

                        </li>
                        `;
                            templatelit2 = templatelit2 + temp;
                        } else {
                            let temp = `<li class=" mb-2 m-0 p-0" >
                        <div class="form-check form-check-inline p-0 m-0">
                        <input class="form-check-input" type="checkbox" id="task${task.id}Check${comm.id}" value="option1" onclick="test(${task.id}, ${comm.id})" checked><span><strike>${comm.data} </strike></span>

                      </div>
                      <br>
                      <span class="postInfo"> ${task.client.client_name} - ${task.project.project_name} - ${task.user.username} </span>
                        </li>`;
                            templatelit2 = templatelit2 + temp;
                        }
                    });

                    if (task.client && task.client.length) {
                        const templatelit3 = `</ul><p class="taskFooter text-right col-12">${task.client.client_name} // ${task.project.project_name} // ${task.user.username}</p>
                        </div>
                        `;
                        tasksBox2.innerHTML = tasksBox2.innerHTML.concat(
                            templateLiteral + templatelit2 + templatelit3
                        );
                    } else {
                        tasksBox2.innerHTML = tasksBox2.innerHTML.concat(
                            templateLiteral + templatelit2
                        );
                    }
                    }
                });

                tasks.events.map(function(event) {
                    if (
                        typeof event.client == "undefined" ||
                        event.client == null
                    ) {
                        let tasksBox3 = document.getElementById("tasks" + i);

                        const templateLiteral = `
                        <div class="row ev-green p-0">
                        <p class="taskMessage col-12 mb-0 ">${event.message}</p>

                        </div>
                        `;
                        tasksBox3.innerHTML = tasksBox3.innerHTML.concat(
                            templateLiteral
                        );
                    } else {
                        let tasksBox3 = document.getElementById("tasks" + i);

                        const templateLiteral = `
                        <div class="row border-bottom ev-green p-0">
                            <p class="taskMessage col-12 mb-0 ">${event.message}</p>

                        </div>
                        `;
                        tasksBox3.innerHTML = tasksBox3.innerHTML.concat(
                            templateLiteral
                        );
                    }
                });

            });

            if(scrolled == false){
                scroll();
                scrolled = true;
            }
        })
        .catch(function(error) {
            console.log(error);
        });


}
var usersSelects = [];
var users = "";
function addUserBtn(){

getUsers();



    var userBox = document.getElementById('usersSelectBox');

    var cantInp = document.getElementById('TaskBtnUserCant');
    var cant = parseInt(cantInp.value);
        var usersSelect = document.getElementById('TaskBtnUserSelect'+cant);
        usersSelects.push(
            {
                'value': usersSelect.value,
                'id': usersSelect.id,
                'name': usersSelect.name
            }
        );

    cant++;
    //console.log(usersSelects);
    userBox.innerHTML = userBox.innerHTML.concat(`
        <select name="TaskBtnUserSelect${cant}" id="TaskBtnUserSelect${cant}" class="custom-select" required>
                        <option value="null">Select...</option>
                    </select>
                    `);
    for(var i = 1; i <= cant; i++){
        var select = document.getElementById('TaskBtnUserSelect'+i);
        users.map(function(user) {
            select.innerHTML = select.innerHTML.concat(`<option value="${user.id}">${user.username}</option>`);
        });

    }
    for(var i = 0; i < cant; i++){
        var select = document.getElementById('TaskBtnUserSelect'+i);
        var opt = usersSelects[i].value;
        select.getElementsByTagName('option')[opt].selected = 'selected';
    }
    //(cant);
    cantInp.setAttribute('value', cant);
}



function test(taskId, commId) {
    //console.log("task:" + taskId + "comm: " + commId);
    fetch("/changeTask/" + taskId + "/" + commId)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            getTasks();
        })
        .catch(function(error) {
            console.log(error);
        });
}

function dotsMenuOpen(id){
    document.getElementById('div'+id).style.display = 'block';


}


function dotsMenuClose(id){
    document.getElementById('div'+id).style.display = 'none';

}

function deleteTask(id, comm){
    //console.log(id + ' ' + comm);
    fetch("/deleteTask/" + id + '/' + comm)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            getTasks();
        })
        .catch(function(error) {
            console.log(error);
        });
}

function addFileBtnPost(){
    var nummm = document.getElementById('filePostModalNum');
    nummm.value = nummm.value + 1;
    var boxFiles = document.getElementById('filePostModal');
    boxFiles.innerHTML = boxFiles.innerHTML.concat(
        `<div class="custom-file col-12 px-5">
        <input type="file" class="custom-file-input" name="PostBtnFile2" id="PostBtnFile2">
        <label class="custom-file-label text-muted" for="PostBtnFile2">Choose file</label>
      </div>`
    );
}


//
