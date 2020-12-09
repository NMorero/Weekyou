@extends('layouts.adminBase')


@section('content')
    <main class="  p-3 d-flex">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Delete</th>

            </tr>
            </thead>
            <tbody>
        @foreach ($roles as $rol)


                <tr>
                    <th scope="row">{{$rol->id}}</th>
                    <td>{{$rol->rol}}</td>
                    <td class="btn btn-primary py-1 px-2 mt-1 ml-4"><a href="/Admin/Roles/Delete/{{$rol->id}}" class="text-white">X</a></td>

                </tr>



        @endforeach

            </tbody>
        </table>
    </main>
@endsection
