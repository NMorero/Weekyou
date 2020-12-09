
getCarousel();



function getCarousel(){
    fetch("/Admin/Projects/get")
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            var carrusel1 = document.getElementById("carrusel1");
            var carrusel2 = document.getElementById('carrusel2');
            carrusel1.innerHTML = "";
            carrusel2.innerHTML = "";
            data.map(function(project) {
                console.log(project.client);


                if(project.status == 'ongoing'){
                    var templateLiteral = `<div class="p-2 divHeightCarousel " id="myBtn${project.id}" >
                <div class="rounded bg-white p-2 divHeightCarousel" data-toggle="modal" data-target=".bd-example-modal-lg${project.id}">
                    <p class="nameProject" style="height:10%">${project.project_name}</p>
                    <p class="m-0 p-0 infoProject">${project.client}</p>
                    <div class="row mt-0 pt-0" >
                        <img class="col-12" src="${project.thumbnail}" onerror="if (this.src != '/resorces/imgExample2.svg') this.src = '/resorces/imgExample2.svg';" height="150vh">


                        <div class="col-12 row text-center pr-4 pl-2 ml-2 pt-1">
                            <img class="col-4 imgProjectSmall px-1 py-0 m-0" src="/resorces/imgExample2.svg" alt="" >
                            <img class="col-4 imgProjectSmall px-1 py-0 m-0" src="/resorces/imgExample2.svg" alt="" >
                            <img class="col-4 imgProjectSmall px-1 py-0 m-0" src="/resorces/imgExample2.svg" alt="" >
                        </div>
                    </div>
                    <p class="row justify-content-between mb-0 mt-1 infoProject " style="text-transform:uppercase"><span class="col-4">${project.status}</span> <span class="col-7 text-right">${project.delivery_date}</span></p>
                    <div class="row boxBtnHover">
                        <p class=" col-3  " onmouseover="document.getElementById('div'+${project.id}).style.display = 'block';" onmouseout="document.getElementById('div'+${project.id}).style.display = 'none';">
                            <span class="rounded-circle bg-secondary text-white btnHoversProject">${project['manager']['name'].charAt(0)}${project['manager']['lastname'].charAt(0)}</span>
                        </p>
                        <div class="rounded bg-white mt-3 ml-2 infoHover" id="div${project.id}" style="position:absolute;display:none">
                            ${project['manager']['name']} ${project['manager']['lastname']}
                        </div>
                            <p class="col-3  " onmouseover="document.getElementById('leader'+${project.id}).style.display = 'block';" onmouseout="document.getElementById('leader'+${project.id}).style.display = 'none';">
                                <span class="rounded-circle  bg-secondary text-white btnHoversProject">${project['leader']['name'].charAt(0)}${project['leader']['lastname'].charAt(0)}</span>
                            </p>
                        <div class="rounded bg-white mt-3 ml-5 infoHover" id="leader${project.id}" style="position:absolute;display:none">
                            ${project['leader']['name']} ${project['leader']['lastname']}
                        </div>
                        <button class="bg-transparent border-0 col-12 m-0 p-0 ml-1 infoProject text-center" onclick="desProject(${project.id})"><i class="fas fa-chevron-down"></i></button>
                    </div>

                </div>
                </div>`;

                carrusel1.innerHTML = carrusel1.innerHTML.concat(templateLiteral);
                var modals = document.getElementById('modals');
                modals.innerHTML = modals.innerHTML.concat(`
                <div class="modal fade bd-example-modal-lg${project.id}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel${project.id}" aria-hidden="true" >
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-body rounded bg-white row">
                                <div class="col-9 row p-0 m-0" id="imgPro${project.id}">

                                </div>
                                <div class="col-3  border-left">
                                    <h5 class mb-1><b>${project.project_name}</b></h5>
                                    <p class="border-bottom">${project.client}</p>
                                    <h5 class="border-bottom mt-2">Manager</h5>
                                    <span>${project['manager']['name']} ${project['manager']['lastname']}</span>
                                    <h5 class="border-bottom mt-2">Leader</h5>
                                    <p >${project['leader']['name']} ${project['leader']['lastname']}</p>
                                    <h5 class="border-bottom mt-2">Developers</h5>
                                    <div id="devPro${project.id}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                `);

                }else{
                    var templateLiteral = `<div class="p-2 divHeightCarousel2" id="myBtn${project.id}" >

                <div class="rounded p-2 pauseProject border divHeightCarousel2">
                <button class="bg-transparent border-0 p-0 m-0 col-12 ml-1 text-center infoProject"  onclick="acProject(${project.id})"><i class="fas fa-chevron-up"></i></button>
                    <p class="p-0 m-0 nameProject" style="height:20%">${project.project_name}</p>
                    <p class="p-0 m-0 infoProject">${project.client}</p>
                    <div class="row mt-0 pt-0">
                        <img class="col-12" src="/resorces/imgExample2.svg"  alt="">

                    </div>
                    <p class="row justify-content-between infoProject mb-0" style="text-transform:uppercase"><span class="col-4">${project.status}</span> <span class="col-7 text-right">${project.delivery_date}</span></p>
                    <div class="row pt-1 boxBtnHover">
                        <p class=" col-3" onmouseover="document.getElementById('div'+${project.id}).style.display = 'block';" onmouseout="document.getElementById('div'+${project.id}).style.display = 'none';">
                            <span class="rounded-circle bg-secondary text-white btnHoversProject">${project['manager']['name'].charAt(0)}${project['manager']['lastname'].charAt(0)}</span>
                        </p>
                        <div class="rounded bg-white mt-3 ml-2 infoHover" id="div${project.id}" style="position:absolute;display:none">
                            ${project['manager']['name']} ${project['manager']['lastname']}
                        </div>
                            <p class="col-3" onmouseover="document.getElementById('leader'+${project.id}).style.display = 'block';" onmouseout="document.getElementById('leader'+${project.id}).style.display = 'none';">
                                <span class="rounded-circle  bg-secondary text-white btnHoversProject">${project['leader']['name'].charAt(0)}${project['leader']['lastname'].charAt(0)}</span>
                            </p>
                        <div class="rounded bg-white mt-3 ml-5 infoHover" id="leader${project.id}" style="position:absolute;display:none">
                            ${project['leader']['name']} ${project['leader']['lastname']}
                        </div>


                    </div>
                </div>
                </div>`;

                carrusel2.innerHTML = carrusel2.innerHTML.concat(templateLiteral);



                }
            });
            $('.carousel1').slick({

                arrows:true,
                nextArrow: $('.next'),
                prevArrow: '<button class="prevBtn rounded-circle bg-dark text-white border-0"><i class="fas fa-chevron-left"></i></button>',
                slidesToShow: 6,
                slidesToScroll: 1
              });
              $('.carousel2').slick({
                arrows:true,
                prevArrow: '<button class="prevBtn2 rounded-circle bg-dark text-white border-0"><i class="fas fa-chevron-left"></i></button>',
                  nextArrow: '<button class="next2 rounded-circle bg-dark text-white border-0" ><i class="fas fa-chevron-right"></i></button>',
                slidesToShow: 6,
                slidesToScroll: 1
              });

              data.map(function(project) {
                if(project.status == 'ongoing'){
                    var imgModal = document.getElementById('imgPro'+project.id);
                console.log('views:'+project.views);
                console.log(imgModal);
                project.views.map(function(view) {
                    let template = `<img class="col-4 mb-3" src="${view}" onerror="if (this.src != '/resorces/imgExample2.svg') this.src = '/resorces/imgExample2.svg';" height="250vh">
                    `;
                    imgModal.innerHTML = imgModal.innerHTML.concat(template);
                });
                imgModal.innerHTML = imgModal.innerHTML.concat(`<img class="col-4 imgProjectSmall px-3 py-0 m-0 " src="/resorces/addImg.png" data-toggle="modal" data-target=".bd-view-modal-lg${project.id}" height="250vh"></img>`);


                var debBox = document.getElementById('devPro'+project.id);
                project.devs.map(function(mDev) {
                    debBox.innerHTML = debBox.innerHTML.concat(`<h5>${mDev.module}</h5><h6>- ${mDev.developer}</h6>`);
                });
                debBox.innerHTML = debBox.innerHTML.concat(`<button class=" buttons-header" data-toggle="modal" data-target="#moduleModal${project.id}">+ Module</button>`);
                }

            });

        })
        .catch(function(error) {
            console.log(error);
        });

}

function addModule(id){
    var form = document.getElementById('addModuleFormPro'+id);



    var url = form.getAttribute("action");
    var formData = {};
    $(form).find("input[name]").each(function (index, node) {
        formData[node.name] = node.value;
    });
    $(form).find("select[name]").each(function (index, node) {
        formData[node.name] = node.value;
    });
    $.post(url, formData).done(function (data) {
        var debBox = document.getElementById('devPro'+id);
        form.reset();
        debBox.innerHTML = "";
        document.getElementById('closeFormModalDev'+id).click();
        fetch("/Admin/Projects/get")
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                data.map(function(project) {
                    var debBox = document.getElementById('devPro'+project.id);
                    project.devs.map(function(mDev) {
                        debBox.innerHTML = debBox.innerHTML.concat(`<h5>${mDev.module}</h5><h6>- ${mDev.developer}</h6>`);
                    });
                    debBox.innerHTML = debBox.innerHTML.concat(`<button class=" buttons-header" data-toggle="modal" data-target="#moduleModal${project.id}">+ Module</button>`);
                });
            })
            .catch(function(error) {
                console.log(error);
            });


    })


    }
function desProject(id){
    fetch("/Admin/Projects/Deactivate/"+id)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            location.reload(true);
        })
        .catch(function(error) {
            console.log(error);
        });
}


function acProject(id){
    fetch("/Admin/Projects/Activate/"+id)
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            location.reload(true);
        })
        .catch(function(error) {
            console.log(error);
        });
}
