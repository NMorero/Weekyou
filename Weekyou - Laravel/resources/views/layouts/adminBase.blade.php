<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" >

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=" {{asset('/css/master.css')}} ">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    @section('head')

    @show
    <title>Archelier | @section('title') @show</title>
</head>
<body  class="admin">

    <header class="header-base px-5 pt-1 justify-content-between row d-none d-lg-block align-center" style="height:2vh;">
        <nav class="col-12 row justify-content-between p-0">

            <div class="col-4 row justify-content-between">
                <div class="col-2  pt-1 dropdownBox ">
                    <span class=" dropBtn rounded-circle bg-secondary p-2 text-white" style="cursor:pointer;">{{substr(auth()->user()->person->name, 0, 1)}}{{substr(auth()->user()->person->last_name, 0, 1)}}</span>
                    <div class="dropdownContent text-center rounded" >
                        <a class="text-center text-decoration-none color-lightGrey" href="/logout">Log Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="row col-10 justify-content-around pt-1">
                    <a class="col-3 buttons-header-admin text-center text-center text-decoration-none shadow" href="/">Home</a>
                    <a class="col-3 buttons-header-admin  text-center text-decoration-none shadow m-0 p-0" href="/Admin/Projects" tabindex="-1" aria-disabled="true">Projects</a>

                    @if (auth()->user()->roles->rol == 'admin')
                    <a class="col-3 buttons-header-admin text-center text-decoration-none shadow px-1" href="/Admin" tabindex="-1" aria-disabled="true">Resources</a>
                    @endif


                </div>

            </div>
            <div class="col-7 text-right pt-2">
                @section('projectAddBtn')

                    @show
            </div>
            <div class="col-1"></div>
          </nav>

    </header>


    @section('content')

    @show




    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="https://kit.fontawesome.com/1c8538c20e.js" crossorigin="anonymous"></script>
    @section('scripts')

    @show
</body>
</html>
