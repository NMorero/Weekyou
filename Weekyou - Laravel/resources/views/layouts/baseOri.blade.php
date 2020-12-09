<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" {{asset('/css/master.css')}} ">
    <link rel="stylesheet" href=" {{asset('/css/header.css')}} ">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,500&display=swap" rel="stylesheet">
    @section('head')

    @show
    <title>Archelier | @section('title') @show</title>

</head>
<body @section('body')

@show>

    <header>
        <span id="userLogo">{{substr(auth()->user()->person->name, 0, 1)}}{{substr(auth()->user()->person->last_name, 0, 1)}}</span>
        <a class="" id="boxUserLogo"  href="/logout">Log Out</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a class="here" href="/">Home</a>
        <a class="linkHeader" href="/Admin/Projects">Projects</a>
        <a class="linkHeader" href="/Admin">Resources</a>
        <a class="linkHeader marginHeaderBtn" href="">Delivery</a>
        <a class="linkHeader" href="">Feedback</a>
    </header>

    @section('content')

    @show



    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="https://kit.fontawesome.com/1c8538c20e.js" crossorigin="anonymous"></script>
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
    @section('scripts')

    @show

</body>
</html>
