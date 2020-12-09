@extends('layouts.adminBase')


@section('content')

        <main class="justify-content-center d-flex p-2">

            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Alias</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Identification code</th>
                    <th scope="col">Country</th>
                    <th scope="col">State</th>
                    <th scope="col">City</th>
                    <th scope="col">Delete</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($persons as $person)
                    <form autocomplete="off" action="/Admin/Persons/Update/{{$person->id}}" method="POST">
                        @csrf
                        <tr>
                            <td>{{$person->id}}</td>
                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="name" id="" value="{{$person->name}}"></td>
                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="last_name" id="" value="{{$person->last_name}}"></td>
                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="dni" id="" value="{{$person->dni}}"></td>
                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="alias" id=""  value="{{$person->alias}}"></td>
                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="email" id="" value="{{$person->email}}"></td>
                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="phone_number" id="" value="{{$person->phone_number}}"></td>
                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="address" id="" value="{{$person->address}}"></td>
                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="identification_code" id="" value="{{$person->identification_code}}"></td>
                            <td class="align-middle">{{$person->country->country_name}}</td>
                            <td class="align-middle">{{$person->state->state_name}}</td>
                            <td class="align-middle">{{$person->city->city_name}}</td>
                            <td class="btn btn-primary py-1 px-2 mt-1 ml-4"><a href="/Admin/Persons/Delete/{{$person->id}}" class="text-white">X</a></td>
                            <td><button class="btn btn-dark" type="submit">Update</button></td>
                        </tr>
                    </form>


                    @endforeach

                </tbody>
            </table>
        </main>

@endsection
