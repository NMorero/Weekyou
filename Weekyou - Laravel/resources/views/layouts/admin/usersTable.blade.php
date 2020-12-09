@extends('layouts.adminBase')


@section('content')
    <main class="  p-3 d-flex">
        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Person</th>
                <th scope="col">Rol</th>
                <th scope="col">Delete</th>

            </tr>
            </thead>
            <tbody>
        @foreach ($users as $user)


                <tr>
                    <form autocomplete="off" action="" method="POST">
                        @csrf
                        <th scope="row">{{$user->id}}</th>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="username" id="" value="{{$user->username}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="email" id="" value="{{$user->email}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="password" id="" value="{{$user->password}}"></td>

                        <td data-toggle="collapse" data-target="#accordion{{$user->id}}" class="clickable">Info</td>
                        <td>{{$user['rol']['rol']}}</td>
                        <td class="btn btn-primary py-1 px-2 mt-1 ml-4"><a href="/Admin/Users/Delete/{{$user->id}}" class="text-white">X</a></td>
                        <td><button class="btn btn-dark" type="submit" formaction="/Admin/Users/Update/{{$user->id}}">Update</button></td>
                    </form>
                </tr>

                <tr id="accordion{{$user->id}}" class="collapse">
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


                            </thead>
                            <tbody>
                                <form autocomplete="off" action="/Admin/Persons/Update/{{$user['person']['id']}}" method="POST">
                                    @csrf

                                        <td class="align-middle">{{$user['person']['id']}}</td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="name" id="" value="{{$user['person']['name']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="last_name" id="" value="{{$user['person']['last_name']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="dni" id="" value="{{$user['person']['dni']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="alias" id=""  value="{{$user['person']['alias']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="email" id="" value="{{$user['person']['email']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="phone_number" id="" value="{{$user['person']['phone_number']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="address" id="" value="{{$user['person']['address']}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="identification_code" id="" value="{{$user['person']['identification_code']}}"></td>

                                        <td class="btn btn-primary py-1 px-2 mt-3 ml-4"><a href="/Admin/Persons/Delete/{{$user['person']['id']}}" class="text-white">X</a></td>
                                        <td><button class="btn btn-dark" type="submit" formaction="/Admin/Persons/Update/{{$user['person']['id']}}">Update</button></td>

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
