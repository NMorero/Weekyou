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
        @foreach ($PRManagers as $manager)


                <tr>
                    <th scope="row">{{$manager->id}}</th>
                    <td>{{$manager->user->username}}</td>
                    <td data-toggle="collapse" data-target="#accordion{{$manager->id}}" class="clickable">Info</td>
                    <td class="btn btn-primary py-1 px-2 mt-1 ml-4"><a href="/Admin/Projects/Managers/Delete/{{$manager->id}}" class="text-white">X</a></td>
                </tr>

                <tr id="accordion{{$manager->id}}" class="collapse">
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
                                <form action="/Admin/Persons/Update/{{$manager['person']['id']}}" method="POST">
                                    @csrf

                                        <td class="align-middle">{{$manager['person']['id']}}</td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="name" id="" value="{{$manager['person']['name']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="last_name" id="" value="{{$manager['person']['last_name']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="dni" id="" value="{{$manager['person']['dni']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="alias" id=""  value="{{$manager['person']['alias']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="email" id="" value="{{$manager['person']['email']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="phone_number" id="" value="{{$manager['person']['phone_number']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="address" id="" value="{{$manager['person']['address']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="identification_code" id="" value="{{$manager['person']['identification_code']}}"></td>

                                        <td class="btn btn-primary py-1 px-2 mt-3 ml-4"><a href="/Admin/Persons/Delete/{{$manager['person']['id']}}" class="text-white">X</a></td>
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
