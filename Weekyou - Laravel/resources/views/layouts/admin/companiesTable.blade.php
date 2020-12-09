@extends('layouts.adminBase')

@section('content')
    <main class="p-3">
        <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name </th>
                <th scope="col">Cuit</th>
                <th scope="col">Alias</th>
                <th scope="col">Website</th>
                <th scope="col">Administrator name</th>
                <th scope="col">Administrator email</th>
                <th scope="col">Production manager name</th>
                <th scope="col">Production email</th>
                <th scope="col">Phone number</th>
                <th scope="col">Address</th>
                <th scope="col">Postal code</th>
                <th scope="col">Identification code</th>
                <th scope="col">Delete</th>
                <th></th>

              </tr>
            </thead>
            <tbody>
              @foreach ($companies as $company)
                <form autocomplete="off" action="" method="POST">
                    @csrf
                    <tr>
                        <th class="align-middle">{{$company->id}}</th>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="name" id="" value="{{$company->name}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="cuit" id="" value="{{$company->cuit}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="alias" id="" value="{{$company->alias}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="website" id="" value="{{$company->website}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="adminName" id="" value="{{$company->administrator_name}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="adminEmail" id="" value="{{$company->administrator_email}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="prodManName" id="" value="{{$company->production_manager_name}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="email" name="prodEmail" id="" value="{{$company->production_email}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="phoneNumber" id="" value="{{$company->phone_number}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="text" name="address" id="" value="{{$company->address}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="postalCode" id="" value="{{$company->postal_code}}"></td>
                        <td class="align-middle"><input class="border-0 rounded bg-transparent" type="number" name="identificationCode" id="" value="{{$company->identification_code}}"></td>
                        <td class="btn btn-primary py-1 px-2 mt-1 ml-4"><a href="/Admin/Companies/Delete/{{$company->id}}" class="text-white">X</a></td>
                        <td><button class="btn btn-dark" type="submit" formaction="/Admin/Company/Update/{{$company->id}}">Update</button></td>

                    </tr>
                </form>
              @endforeach

            </tbody>
          </table>
    </main>
@endsection
