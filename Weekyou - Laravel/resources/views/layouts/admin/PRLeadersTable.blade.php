@extends('layouts.adminBase')


@section('content')
    <main class="  p-3 d-flex">
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Person</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
        @foreach ($PRLeaders as $leader)


                <tr>
                    <th scope="row">{{$leader->id}}</th>
                    <td>{{$leader->user->username}}</td>
                    <td data-toggle="collapse" data-target="#accordion{{$leader->id}}" class="clickable">Info</td>
                    <td class="btn btn-primary py-1 px-2 mt-1 ml-4"><a href="/Admin/Projects/Leaders/Delete/{{$leader->id}}" class="text-white">X</a></td>
                </tr>

                <tr id="accordion{{$leader->id}}" class="collapse">
                    <td colspan="3">
                        <table class="table table-sm">
                            <thead>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Last Name</th>
                                <th>Dni</th>
                                <th>Alias</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Identification Code</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <form autocomplete="off" action="/Admin/Persons/Update/{{$leader['person']['id']}}" method="POST">
                                    @csrf

                                        <td class="align-middle">{{$leader['person']['id']}}</td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="name" id="" value="{{$leader['person']['name']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="last_name" id="" value="{{$leader['person']['last_name']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="dni" id="" value="{{$leader['person']['dni']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="alias" id=""  value="{{$leader['person']['alias']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="email" id="" value="{{$leader['person']['email']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="phone_number" id="" value="{{$leader['person']['phone_number']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="address" id="" value="{{$leader['person']['address']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="identification_code" id="" value="{{$leader['person']['identification_code']}}"></td>

                                        <td class="btn btn-primary py-1 px-2 mt-3 ml-4"><a href="/Admin/Persons/Delete/{{$leader['person']['id']}}" class="text-white">X</a></td>
                                        <td><button class="btn btn-dark" type="submit">Update</button></td>

                                </form>

                            </tbody>
                        </table>
                    </td>
                </tr>


        @endforeach

            </tbody>
        </table>
    </main>
@endsection
