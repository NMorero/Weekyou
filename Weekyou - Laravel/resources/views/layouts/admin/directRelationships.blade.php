@extends('layouts.adminBase')



@section('content')
<main class="  p-3 d-flex">
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Company labor relationship</th>
            <th scope="col">Social work</th>
            <th scope="col">Labor Agreement</th>

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
                <td>{{$relation->directRelation->company_labor_relationship}}</td>
                <td>{{$relation->directRelation->social_work}}</td>
                <td>{{$relation->directRelation->labor_agreement}}</td>

                <td>{{$relation->directRelation->iva_condition}}</td>
                <td>{{$relation->directRelation->account_bank}}</td>
                <td>{{$relation->directRelation->account_number}}</td>
                <td>{{$relation->directRelation->cbu_number}}</td>
                <td>{{$relation->directRelation->familyContact_name}}</td>
                <td>{{$relation->directRelation->familyContact_phoneNumber}}</td>
                <td>{{$relation->directRelation->familyContact_address}}</td>
                <td>{{$relation['person']}}</td>

           </tr>


    @endforeach

        </tbody>
    </table>
</main>
@endsection
