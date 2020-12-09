@extends('layouts.adminBase')

@section('content')
<main class="  p-3 d-flex">
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">IVA condition</th>
            <th scope="col">Account bank</th>
            <th scope="col">Account number</th>
            <th scope="col">CBU</th>
            <th scope="col">Family contact name</th>
            <th scope="col">Family contact phone number</th>
            <th scope="col">Family contact address</th>
            <th scope="col">Person</th>


        </tr>
        </thead>
        <tbody>
    @foreach ($relations as $relation)


           <tr>
                <th>{{$relation->id}}</th>
                <td>{{$relation->freelanceRelation->iva_condition}}</td>
                <td>{{$relation->freelanceRelation->account_bank}}</td>
                <td>{{$relation->freelanceRelation->account_number}}</td>
                <td>{{$relation->freelanceRelation->cbu_number}}</td>
                <td>{{$relation->freelanceRelation->familyContact_name}}</td>
                <td>{{$relation->freelanceRelation->familyContact_phoneNumber}}</td>
                <td>{{$relation->freelanceRelation->familyContact_address}}</td>
                <td>{{$relation['person']}}</td>
           </tr>


    @endforeach

        </tbody>
    </table>
</main>
@endsection
