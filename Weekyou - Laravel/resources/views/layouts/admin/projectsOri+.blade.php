<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Weekyou | Projects</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.5.2/vue.min.js"></script>
    <!-- CDNJS :: Sortable (https://cdnjs.com/) -->
    <script src="//cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>
    <!-- CDNJS :: Vue.Draggable (https://cdnjs.com/) -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/projects.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
</head>
<body>
    <header>
        <span id="userLogo">{{substr(auth()->user()->person->name, 0, 1)}}{{substr(auth()->user()->person->last_name, 0, 1)}}</span>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a class="linkHeader" href="/">Home</a>
        <a class="here" href="/Admin/Projects">Projects</a>
        <a class="linkHeader" href="/Admin">Resources</a>
        <a class="linkHeader marginHeaderBtn" href="">Delivery</a>
        <a class="linkHeader" href="">Feedback</a>
    </header>
    <a class="" id="boxUserLogo"  href="/logout">Log Out</a>
    <div id="app">
        <draggable-component></draggable-component>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- <script>
        var socket = io.connect('http://186.108.203.181:4200');
        socket.on('connect', function(data) {
            console.log('ok');
            socket.emit('join', 'Hello World from client');
        });
       </script>
    -->
        <script>
            $(document).click(function(event){
                //console.log(event.target.id);
                if(event.target.id == 'userLogo' || event.target.id == 'boxUserLogo'){
                    $('#boxUserLogo').css('display', 'block');
                }else{
                    $('#boxUserLogo').css('display', 'none');
                }

            });

        </script>
</body>
</html>
