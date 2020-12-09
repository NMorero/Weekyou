<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drawing App</title>
    <link rel="stylesheet" href="{{asset('/css/feedback.css')}}">
    <script src="https://kit.fontawesome.com/1c8538c20e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Muli:400,500&display=swap" rel="stylesheet">
    <style>
        canvas{
            border: 2px solid black;
        }
    </style>

</head>
<body>
    <header>
        <a class="col-3 buttons-header text-center text-center text-decoration-none shadow" href="/">Home</a>
                    <a class=" buttons-header   " href="/Admin/Projects" tabindex="-1" aria-disabled="true">Projects</a>

                    @if (auth()->user()->roles->rol == 'admin')
                    <a class="buttons-header text-center  " href="/Admin" tabindex="-1" aria-disabled="true">Resources</a>
                    @endif
    </header>
    <div id="app">

        <example-component></example-component>

</div>

<script src="https://cdn.rawgit.com/magicien/undo-canvas/v0.1.3/undo-canvas.js"></script>
    <script src="{{asset('/js/app.js')}}"></script>
    <script src="{{asset('/js/feedCreate.js')}}"></script>
</body>
</html>
