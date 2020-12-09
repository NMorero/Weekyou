
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
$("#editFeedback").on("submit", function(e){

    e.preventDefault();
    console.log('si')
    var f = $(this);
    var formData = new FormData;


    var chekboxes = document.querySelectorAll('.checkboxes');
    var comments = JSON.parse(document.getElementById('comments').value);
    console.log(comments);
    var ckecks = [];
    for (i = 0; i < chekboxes.length; i++) {

        if(chekboxes[i].checked == true){

            comments.forEach(comm => {
                if(comm.id == i+1){

                    comm.status = 'done';
                }
            });
        }else{

            comments.forEach(comm => {
                if(comm.id == i+1){

                    comm.status = 'undone';
                }
            });
        }
    }
    var id = document.getElementById('id').value;
    comments = JSON.stringify(comments);

    $.ajax({

        type:'POST',

        url:'/Feedback/Edit/saveFeedback',

        data:{comments:comments, id:id},

        success:function(data){

            window.location.replace("/");

        }

     });


 });


