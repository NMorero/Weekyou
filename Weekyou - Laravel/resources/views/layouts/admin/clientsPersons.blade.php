@extends('layouts.adminBase')

@section('content')
<main class="row p-3">
<table class="table table-sm table-hover" >
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>

            <th>Person</th>
            <th></th>
          </tr>
        </thead>

        <tbody>

            @foreach ($clients as $client)
                <form autocomplete="off" action="/Admin/Clients/Person/Update/{{$client->id}}" method="POST">
                    @csrf
                    <tr >
                        <td>{{$client->id}}</td>
                        <td><input class="border-0 rounded bg-transparent" type="text" name="client_name" id="" value="{{$client->client_name}}"></td>
                        <td><input class="border-0 rounded bg-transparent" type="text" name="client_type" id="" value="{{$client->type}}"></td>
                        <td data-toggle="collapse" data-target="#accordion{{$client->id}}" class="clickable">Info</td>
                        <td><button class="btn btn-dark" type="submit">Update</button></td>
                    </tr>
                        <form autocomplete="off" action="/Admin/Persons/Update/{{$client->person->id}}">
                            <tr id="accordion{{$client->id}}" class="collapse">
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
                                            <td>{{$client->person->id}}</td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="name" id="" value="{{$client->person->name}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="last_name" id="" value="{{$client->person->last_name}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="dni" id="" value="{{$client->person->dni}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="alias" id=""  value="{{$client->person->alias}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="email" id="" value="{{$client->person->email}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="phone_number" id="" value="{{$client->person->phone_number}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="address" id="" value="{{$client->person->address}}"></td>
                                            <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="identification_code" id="" value="{{$client->person->identification_code}}"></td>
                                            <td><button class="btn btn-dark" type="submit" formaction="/Admin/Persons/Update/{{$client->person->id}}">Update</button></td>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </form>
                </form>
            @endforeach
        </tbody>
        </table>
</main>
@endsection

@section('scripts')
<script src="{{asset('js/adminFunctions.js')}}"></script>

@endsection
