@extends('layouts.adminBase')


@section('content')
    <main class="p-2">
        <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">User </th>
                <th scope="col">Person</th>
                <th scope="col">Delete</th>

              </tr>
            </thead>
            <tbody>

                @foreach ($developers as $developer)

                <tr >
                    <td class="align-middle">{{$developer->id}}</td>
                    <td>{{$developer->username}}</td>

                    <td data-toggle="collapse" data-target="#accordion{{$developer->id}}" class="clickable">Info</td>
                    <td class="btn btn-primary py-1 px-2 mt-1 ml-4"><a href="/Admin/Developers/Delete/{{$developer->id}}" class="text-white">X</a></td>

                    </tr>
                    <tr id="accordion{{$developer->id}}" class="collapse">
                        <td colspan="3">
                            <table class="table table-sm">
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">Alias</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Identification code</th>
                                    <th scope="col">Delete</th>
                                </thead>
                                <tbody>
                                    <form autocomplete="off" action="/Admin/Persons/Update/{{$developer['person']['id']}}" method="POST">
                                        @csrf

                                            <td class="align-middle">{{$developer['person']['id']}}</td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="name" id="" value="{{$developer['person']['name']}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="last_name" id="" value="{{$developer['person']['last_name']}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="dni" id="" value="{{$developer['person']['dni']}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="alias" id=""  value="{{$developer['person']['alias']}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="email" id="" value="{{$developer['person']['email']}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="phone_number" id="" value="{{$developer['person']['phone_number']}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="address" id="" value="{{$developer['person']['address']}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="identification_code" id="" value="{{$developer['person']['identification_code']}}"></td>

                                            <td class="btn btn-primary py-1 px-2 mt-3 ml-4"><a href="/Admin/Persons/Delete/{{$developer['person']['id']}}" class="text-white">X</a></td>
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
