@extends('layouts.adminBase')



@section('content')
    <main class="container p-4">


        <div class="col-12 row">

                @if (auth()->user()->roles->rol == 'admin' || auth()->user()->roles->rol == 'PRmanager' || auth()->user()->roles->rol == 'PRleader')
                <div class="col-12 justify-content-center row mb-4">
                    <button type="button" class="btn btn-primary col-4" data-toggle="modal" data-target="#view">
                        Add
                      </button>
                </div>
                @endif


            </div>
        </div>
    </div>
</div>
</div>


        <div class="col-12 justify-content-between d-flex row">
            @foreach ($views as $view)
                <div class="col-3 row">
                        <img class="col-11" src="{{$view->image}}" alt="img" >
                        @if (auth()->user()->roles->rol == 'admin' || auth()->user()->roles->rol == 'PRmanager' || auth()->user()->roles->rol == 'PRleader')
                        <a href="/Admin/Project/Views/Delete/{{$view->id}}" class="btn btn-danger col-11">Delete</a>
                        @endif
                </div>
            @endforeach
        </div>

    </main>
@endsection
