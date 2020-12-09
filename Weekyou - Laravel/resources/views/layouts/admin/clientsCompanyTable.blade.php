@extends('layouts.adminBase')

@section('content')
<main class="container-fluid row pl-5">
    <table  class="table table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Company</th>
            <th></th>
          </tr>
        </thead>

        <tbody>

            @foreach ($clients as $client)
            <form autocomplete="off" action="/Admin/Clients/Update/{{$client->id}}" method="POST">
                @csrf
                <tr >
                    <td>{{$client->id}}</td>
                    <td><input class="border-0 rounded bg-transparent" type="text" name="client_name" id="" value="{{$client->client_name}}"></td>
                    <td><input class="border-0 rounded bg-transparent" type="text" name="client_type" id="" value="{{$client->type}}"></td>
                    <td data-toggle="collapse" data-target="#accordion{{$client->id}}" class="clickable">Info</td>
                    <td><button class="btn btn-dark" type="submit">Update</button></td>

                    </tr>
                </form>
                    <tr id="accordion{{$client->id}}" class="collapse">
                        <td colspan="3">
                            <table class="table table-sm">
                                <thead>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Cuit</th>
                                    <th>Alias</th>
                                    <th>Website</th>
                                    <th>Administrator Name</th>
                                    <th>Administrator Email</th>
                                    <th>Production Manager</th>
                                    <th>Production Email</th>
                                    <th>Phone Number</th>
                                    <th>Identification Code</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <form autocomplete="off" action="" method="POST">
                                        @csrf
                                        <td>{{$client->company->id}}</td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="name" id="" value="{{$client->company->name}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="cuit" id="" value="{{$client->company->cuit}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="alias" id="" value="{{$client->company->alias}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="website" id="" value="{{$client->company->website}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="adminName" id="" value="{{$client->company->administrator_name}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="adminEmail" id="" value="{{$client->company->administrator_email}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="prodManName" id="" value="{{$client->company->production_manager_name}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="prodEmail" id="" value="{{$client->company->production_email}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="phoneNumber" id="" value="{{$client->company->phone_number}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="address" id="" value="{{$client->company->address}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="postalCode" id="" value="{{$client->company->postal_code}}"></td>
                                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="identificationCode" id="" value="{{$client->company->identification_code}}"></td>
                                        <td><button class="btn btn-dark" type="submit" formaction="/Admin/Company/Update/{{$client->company->id}}">Update</button></td>
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
