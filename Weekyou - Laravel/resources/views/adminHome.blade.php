@extends('layouts.adminBase')
@section('head')
    <style>
        @import url(http://fonts.googleapis.com/css?family=Droid+Serif);
        /* Above line is to import google font style */

        .active{
        color:red;
        }
        fieldset{
        display:none;

        }
        #first{
        display:block;


        }

        li{

display:inline;
color:#c1c5cc;
font-family: 'Droid Serif', serif;
}

        </style>
@endsection
@section('content')
    <main class="container bg-lightGrey justify-content-between ">


        <div class="row mt-5">

    <div class="col-xl-4 col-lg-4">
        <div class="card" style="margin-top:10px">
                <div class="card-header">
                <h5 class="card-title text-center">Users</h5>
        </div>
            <div class="card" style="margin:8px">
                <div class="card-body">
                    <div >

                        <p class="card-text">Add or see all the users..</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Users">
                Add
              </button>
              <a href="/Admin/Users" class="btn btn-secondary text-decoration-none text-white">View</a>
            </div>

    </div>
</div>
</div>
</div>


<div class="col-xl-4 col-lg-4">
<div class="card" style="margin-top:10px">
    <div class="card-header">
        <h5 class="card-title">Projects</h5>
    </div>
    <div class="card" style="margin:8px">
        <div class="card-body">
            <div >
                <p class="card-text">Add or see all the projects..</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Projects">
                    Add
                </button>
                <a href="/Admin/Projects" class="btn btn-secondary text-decoration-none text-white">View</a>
            </div>
        </div>
    </div>
</div>
</div>


    <div class="col-xl-4 col-lg-4">
        <div class="card" style="margin-top:10px">
                <div class="card-header">
                <h5 class="card-title">Companies</h5>
        </div>
            <div class="card" style="margin:8px">
                <div class="card-body">
                    <div >
                        <p class="card-text">Add or see all the companies on the DB.</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Companies">
                Add
              </button>
            <a href="/Admin/Companies" class="btn btn-secondary text-decoration-none text-white">View</a>
        </div>
    </div>
</div>
</div>
</div>



    <div class="col-xl-4 col-lg-4">
        <div class="card" style="margin-top:10px">
                <div class="card-header">
                <h5 class="card-title">Developers</h5>
        </div>
            <div class="card" style="margin:8px">
                <div class="card-body">
                    <div >

                        <p class="card-text">Add or see all the developers..</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Developers">
                Add
              </button>


            <a href="/Admin/Developers" class="btn btn-secondary text-decoration-none text-white">View</a>
        </div>
    </div>
</div>
</div>
</div>


<div class="col-xl-4 col-lg-4">
<div class="card" style="margin-top:10px">
        <div class="card-header">
        <h5 class="card-title">Roles</h5>
</div>
    <div class="card" style="margin:8px">
        <div class="card-body">
            <div >

                <p class="card-text">Add or see all the roles..</p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Roles">
        Add
      </button>
    <a href="/Admin/Roles" class="btn btn-secondary text-decoration-none text-white">View</a>
</div>
</div>
</div>
</div>
</div>


<div class="col-xl-4 col-lg-4">
<div class="card" style="margin-top:10px">
        <div class="card-header">
        <h5 class="card-title">Persons</h5>
</div>
    <div class="card" style="margin:8px">
        <div class="card-body">
            <div >

                <p class="card-text">Add or see all the Persons..</p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Persons">
        Add
      </button>


    <a href="/Admin/Persons" class="btn btn-secondary text-decoration-none text-white">View</a>
</div>
</div>
</div>
</div>
</div>



<div class="col-xl-4 col-lg-4">
<div class="card" style="margin-top:10px">
        <div class="card-header">
        <h5 class="card-title">Relationships</h5>
</div>
    <div class="card" style="margin:8px">
        <div class="card-body">
            <div >
                <h5>Direct</h5>
                <p class="card-text">Add or see all the Direct Persons..</p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#relationships">
        Add
      </button>



    <a href="/Admin/Relationships/Direct" class="btn btn-secondary text-decoration-none text-white">View</a>
            </div>
        </div>
    </div>

    <div class="card" style="margin:8px">
        <div class="card-body">
            <div >
                <h5>Freelance relattionship</h5>
                <p class="card-text">Add or see all the freelance relation persons..</p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#directRelation">
        Add
      </button>



    <a href="/Admin/Relationships/Freelance" class="btn btn-secondary text-decoration-none text-white">View</a>
            </div>
        </div>
    </div>

</div>
</div>




<div class="col-xl-4 col-lg-4">
<div class="card" style="margin-top:10px">
        <div class="card-header">
        <h5 class="card-title">Clients</h5>
    </div>
    <div class="card" style="margin:8px">
        <div class="card-body">
            <div >
                <h5 class="card-title">Person</h5>
                <p class="card-text">The person who represent a Client Company.</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                    Add
                  </button>



                <a href="/Admin/Clients/Person" class="btn btn-secondary text-decoration-none text-white">View</a>
            </div>
        </div>
    </div>
    <div class="card" style="margin:8px">
        <div class="card-body">
            <div >
                <h5 class="card-title">Company</h5>
                <p class="card-text">Create or edit clients as company.</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ClientCompanyModal">
                    Add
                  </button>


                <a href="/Admin/Clients/Company" class="btn btn-secondary text-decoration-none text-white">View</a>
                </div>
        </div>
    </div>
</div>
</div>

        </div>





<!-- Modal company Client-->
<div class="modal fade" id="ClientCompanyModal" tabindex="-1" role="dialog" aria-labelledby="ClientCompanyModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ClientCompanyModalTitle">New Company Client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" action="/Admin/addClientsCompany" id="clientCompanyForm" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="name">

                  </div>
                  <div class="form-group">
                    <label for="company">Company</label>
                    <select class="custom-select" name="company" id="company">
                        <option value="none">Select..</option>
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach

                    </select>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
            </form>
        </div>

      </div>
    </div>
  </div>



<!-- Modal Users-->
<div class="modal fade" id="Users" tabindex="-1" role="dialog" aria-labelledby="UsersTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="UsersTitle">New User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" action="/Admin/Users/addUser" class="regform" method="POST">
                @csrf
                <!-- Progress Bar -->
                <ul id="progressbar" class="justify-content-around d-flex">
                    <li class="active">Create person</li>
                    <li>Person relationship</li>
                    <li>Create user</li>

                </ul>
                <!-- Fieldsets -->
                <fieldset id="first">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>

                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="last_name" required>

                    </div>

                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="number" name="dni" class="form-control" id="dni" aria-describedby="dni" required>

                    </div>

                    <div class="form-group">
                        <label for="alias">Alias</label>
                        <input type="text" name="alias" class="form-control" id="alias" aria-describedby="alias" required>

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="email" required>

                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone number</label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" aria-describedby="phone_number" required>

                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" aria-describedby="address" required>

                    </div>

                    <div class="form-group">
                        <label for="identification_code">Identification code</label>
                        <input type="number" name="identification_code" class="form-control" id="identification_code" aria-describedby="identification_code" required>

                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <select class="custom-select" name="country" id="">
                            <option value="none">Select..</option>
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->country_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="custom-select" name="state" id="">
                            <option value="none">Select..</option>
                            @foreach ($states as $state)
                                <option value="{{$state->id}}">{{$state->state_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="custom-select" name="city" id="">
                            <option value="none">Select..</option>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                    <input class="next_btn btn btn-info" name="next" type="button" value="Next">
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="relationship">Relationship</label>
                        <select class="custom-select" name="relationship" id="relationshipSelect1">
                            <option value="none">Select..</option>
                            <option value="1">Direct</option>
                            <option value="2">Freelance</option>
                        </select>
                    </div>





                    <div id="relationForm1">
                    </div>
                    <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                    <input class="next_btn btn btn-info" name="next" type="button" value="Next">
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control" id="password" aria-describedby="password" required>
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select class="custom-select" name="rol" id="" required>
                            <option value="none">Select..</option>
                            @foreach ($roles as $rol)
                                <option value="{{$rol->id}}">{{$rol->rol}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                    <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </fieldset>
                </form>
        </div>
    </div>
  </div>

</div>


<!-- Modal Projects -->
<div class="modal fade" id="Projects" tabindex="-1" role="dialog" aria-labelledby="ProjectsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ProjectsTitle">New Project</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" action="/Admin/Projects/addProject" id="projectsForm" method="post">
                @csrf

                <div class="form-group">
                    <label for="projectName">Project name</label>
                    <input type="text" name="projectName" class="form-control" id="projectName" aria-describedby="projectName" required>
                </div>

                <div class="form-group">
                    <label for="deliveryDate">Delivery date</label>
                    <input type="date" name="deliveryDate" class="form-control" id="deliveryDate" aria-describedby="deliveryDate" required>
                </div>


                <div class="form-group">
                    <label for="client">Client</label>
                    <select class="custom-select" name="client" id="" required>
                        <option value="none">Select..</option>
                        @foreach ($clients as $client)
                            <option value="{{$client->id}}">{{$client->client_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="manager">Manager</label>
                    <select class="custom-select" name="manager" id="">
                        <option value="none">Select..</option>
                        @foreach ($managers as $manager)
                            <option value="{{$manager->id}}">{{$manager->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="leader">Leader</label>
                    <select class="custom-select" name="leader" id="">
                        <option value="none">Select..</option>
                        @foreach ($leaders as $leader)
                            <option value="{{$leader->id}}">{{$leader->name}}</option>
                        @endforeach
                    </select>
                </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>

      </div>
    </div>
  </div>

<!-- Modal Company-->
<div class="modal fade" id="Companies" tabindex="-1" role="dialog" aria-labelledby="CompaniesTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="CompaniesTitle">New Company</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" action="/Admin/Companies/addCompany" id="clientPersonForm" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>

                </div>

                <div class="form-group">
                    <label for="cuit">Cuit</label>
                    <input type="text" name="cuit" class="form-control" id="cuit" aria-describedby="cuit" required>
                </div>

                <div class="form-group">
                    <label for="alias">Alias</label>
                    <input type="text" name="alias" class="form-control" id="alias" aria-describedby="alias" required>
                </div>

                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" name="website" class="form-control" id="website" aria-describedby="website" required>
                </div>

                <div class="form-group">
                    <label for="adminName">Administrator name</label>
                    <input type="text" name="adminName" class="form-control" id="adminName" aria-describedby="adminName" required>
                </div>

                <div class="form-group">
                    <label for="adminEmail">Administrator email</label>
                    <input type="email" name="adminEmail" class="form-control" id="adminEmail" aria-describedby="adminEmail" required>
                </div>

                <div class="form-group">
                    <label for="prodManName">Production manager name</label>
                    <input type="text" name="prodManName" class="form-control" id="prodManName" aria-describedby="prodManName" required>
                </div>

                <div class="form-group">
                    <label for="prodEmail">Production Email</label>
                    <input type="email" name="prodEmail" class="form-control" id="prodEmail" aria-describedby="prodEmail" required>
                </div>

                <div class="form-group">
                    <label for="phoneNumber">Phone number</label>
                    <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" aria-describedby="phoneNumber" required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" id="address" aria-describedby="address" required>
                </div>

                <div class="form-group">
                    <label for="postalCode">Postal code</label>
                    <input type="number" name="postalCode" class="form-control" id="postalCode" aria-describedby="postalCode" required>
                </div>

                <div class="form-group">
                    <label for="identificationCode">Identification code</label>
                    <input type="number" name="identificationCode" class="form-control" id="identificationCode" aria-describedby="identificationCode" required>
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="custom-select" name="country" id="">
                        <option value="none">Select..</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->country_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="state">State</label>
                    <select class="custom-select" name="state" id="">
                        <option value="none">Select..</option>
                        @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->state_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <select class="custom-select" name="city" id="">
                        <option value="none">Select..</option>
                        @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>


                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                  </div>
            </form>
        </div>

      </div>
    </div>
  </div>

<!-- Modal Developers -->
<div class="modal fade" id="Developers" tabindex="-1" role="dialog" aria-labelledby="DevelopersTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DevelopersTitle">New Developer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#DevelopersNUser">
                New User
              </button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#DevelopersFUser">
                From User
              </button>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="DevelopersFUser" tabindex="-1" role="dialog" aria-labelledby="DevelopersFUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DevelopersFUserTitle">New Developer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" action="/Admin/Developers/addDeveloper" id="developerForm" method="post">
                @csrf

                <div class="form-group">
                    <label for="user">User</label>
                    <select class="custom-select" name="user" id="user">
                        <option value="none">Select..</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->username}}</option>
                        @endforeach
                    </select>
                  </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="DevelopersNUser" tabindex="-1" role="dialog" aria-labelledby="DevelopersNUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DevelopersNUserTitle">New Developer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" action="/Admin/Users/addUser" class="regform" method="POST">
                @csrf
                <!-- Progress Bar -->
                <ul id="progressbar" class="justify-content-around d-flex">
                    <li class="active">Create person</li>
                    <li>Person relationship</li>
                    <li>Create user</li>

                </ul>
                <!-- Fieldsets -->
                <fieldset id="first">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>

                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="last_name" required>

                    </div>

                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="number" name="dni" class="form-control" id="dni" aria-describedby="dni" required>

                    </div>

                    <div class="form-group">
                        <label for="alias">Alias</label>
                        <input type="text" name="alias" class="form-control" id="alias" aria-describedby="alias" required>

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="email" required>

                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone number</label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" aria-describedby="phone_number" required>

                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" aria-describedby="address" required>

                    </div>

                    <div class="form-group">
                        <label for="identification_code">Identification code</label>
                        <input type="number" name="identification_code" class="form-control" id="identification_code" aria-describedby="identification_code" required>

                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <select class="custom-select" name="country" id="">
                            <option value="none">Select..</option>
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->country_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="custom-select" name="state" id="">
                            <option value="none">Select..</option>
                            @foreach ($states as $state)
                                <option value="{{$state->id}}">{{$state->state_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="custom-select" name="city" id="">
                            <option value="none">Select..</option>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                    <input class="next_btn btn btn-info" name="next" type="button" value="Next">
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="relationship">Relationship</label>
                        <select class="custom-select" name="relationship" id="relationshipSelect2">
                            <option value="none">Select..</option>
                            <option value="1">Direct</option>
                            <option value="2">Freelance</option>
                        </select>
                    </div>





                    <div id="relationForm2">






                    </div>



                    <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                    <input class="next_btn btn btn-info" name="next" type="button" value="Next">

                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="username" required>
                    </div>



                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control" id="password" aria-describedby="password" required>
                    </div>

                    <input type="text" name="rol" id="rol" value="2" hidden>

                    <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">

                    <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </fieldset>

                </form>
        </div>

      </div>
    </div>
  </div>


<!-- Modal Roles -->
<div class="modal fade" id="Roles" tabindex="-1" role="dialog" aria-labelledby="RolesTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="RolesTitle">New Rol</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" action="/Admin/Roles/addRol" id="developerForm" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Rol name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>

                </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>

      </div>
    </div>
  </div>

<!-- Modal Persons -->
<div class="modal fade " id="Persons" tabindex="-1" role="dialog" aria-labelledby="PersonsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="PersonsTitle">New Persons</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" action="/Admin/Persons/addPersons" id="developerForm" method="post" class="p-3">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>

                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="last_name" required>

                </div>

                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="number" name="dni" class="form-control" id="dni" aria-describedby="dni" required>

                </div>

                <div class="form-group">
                    <label for="alias">Alias</label>
                    <input type="text" name="alias" class="form-control" id="alias" aria-describedby="alias" required>

                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="email" required>

                </div>

                <div class="form-group">
                    <label for="phone_number">Phone number</label>
                    <input type="number" name="phone_number" class="form-control" id="phone_number" aria-describedby="phone_number" required>

                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" id="address" aria-describedby="address" required>

                </div>

                <div class="form-group">
                    <label for="identification_code">Identification code</label>
                    <input type="number" name="identification_code" class="form-control" id="identification_code" aria-describedby="identification_code" required>

                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="custom-select" name="country" id="">
                        <option value="none">Select..</option>
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->country_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="state">State</label>
                    <select class="custom-select" name="state" id="">
                        <option value="none">Select..</option>
                        @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->state_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <select class="custom-select" name="city" id="">
                        <option value="none">Select..</option>
                        @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>



                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>



            </form>
        </div>

      </div>
    </div>
  </div>



          <!-- Modal Managers -->
          <div class="modal fade" id="PRManager" tabindex="-1" role="dialog" aria-labelledby="PRManagerTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="PRManagerTitle">New PR manager</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PRManagerNUser">
                        New User
                      </button>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PRManagerFUser">
                        From User
                      </button>
                </div>

              </div>
            </div>
          </div>

             <!-- Modal -->
          <div class="modal fade" id="PRManagerFUser" tabindex="-1" role="dialog" aria-labelledby="PRManagerFUserrTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="PRManagerFUserrTitle">New PR manager</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" action="/Admin/Managers/addProjectManager" id="PRManagerFUserForm" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="user">User</label>
                            <select class="custom-select" name="user" id="user">
                                <option value="none">Select..</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->username}}</option>
                                @endforeach
                            </select>
                          </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

              </div>
            </div>
          </div>
           <!-- Modal -->
           <div class="modal fade" id="PRManagerNUser" tabindex="-1" role="dialog" aria-labelledby="PRManagerNUserTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="PRManagerNUserTitle">New PR manager</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" action="/Admin/Users/addUser" class="regform" method="POST">
                        @csrf
                        <!-- Progress Bar -->
                        <ul id="progressbar" class="justify-content-around d-flex">
                            <li class="active">Create person</li>
                            <li>Person relationship</li>
                            <li>Create user</li>

                        </ul>
                        <!-- Fieldsets -->
                        <fieldset id="first">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>

                            </div>
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="last_name" required>

                            </div>

                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="number" name="dni" class="form-control" id="dni" aria-describedby="dni" required>

                            </div>

                            <div class="form-group">
                                <label for="alias">Alias</label>
                                <input type="text" name="alias" class="form-control" id="alias" aria-describedby="alias" required>

                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="email" required>

                            </div>

                            <div class="form-group">
                                <label for="phone_number">Phone number</label>
                                <input type="number" name="phone_number" class="form-control" id="phone_number" aria-describedby="phone_number" required>

                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" aria-describedby="address" required>

                            </div>

                            <div class="form-group">
                                <label for="identification_code">Identification code</label>
                                <input type="number" name="identification_code" class="form-control" id="identification_code" aria-describedby="identification_code" required>

                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <select class="custom-select" name="country" id="">
                                    <option value="none">Select..</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->country_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="state">State</label>
                                <select class="custom-select" name="state" id="">
                                    <option value="none">Select..</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}">{{$state->state_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <select class="custom-select" name="city" id="">
                                    <option value="none">Select..</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                            <input class="next_btn btn btn-info" name="next" type="button" value="Next">
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="relationship">Relationship</label>
                                <select class="custom-select" name="relationship" id="relationshipSelect3">
                                    <option value="none">Select..</option>
                                    <option value="1">Direct</option>
                                    <option value="2">Freelance</option>
                                </select>
                            </div>





                            <div id="relationForm3">






                            </div>



                            <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                            <input class="next_btn btn btn-info" name="next" type="button" value="Next">

                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" aria-describedby="username" required>
                            </div>

                            <input type="text" name="rol" id="rol" value="3" hidden>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" class="form-control" id="password" aria-describedby="password" required>
                            </div>

                            <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">

                            <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        </fieldset>

                        </form>
                </div>

              </div>
            </div>
          </div>





           <!-- Modal -->
           <div class="modal fade" id="PRLeader" tabindex="-1" role="dialog" aria-labelledby="PRLeaderTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="PRLeaderTitle">New PR Leader</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PRLeaderNUser">
                        New User
                      </button>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PRLeaderFUser">
                        From User
                      </button>
                </div>


              </div>
            </div>
          </div>


           <!-- Modal -->
           <div class="modal fade" id="PRLeaderFUser" tabindex="-1" role="dialog" aria-labelledby="PRLeaderFUserTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="PRLeaderFUserTitle">New PR Leader</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" action="/Admin/Managers/addProjectLeader" id="PRLeaderFUserForm" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="user">User</label>
                            <select class="custom-select" name="user" id="user">
                                <option value="none">Select..</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->username}}</option>
                                @endforeach
                            </select>
                          </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>


              </div>
            </div>
          </div>
           <!-- Modal -->
           <div class="modal fade" id="PRLeaderNUser" tabindex="-1" role="dialog" aria-labelledby="PRLeaderNUserTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="PRLeaderNUserTitle">New PR Leader</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" action="/Admin/Users/addUser" class="regform" method="POST">
                        @csrf
                        <!-- Progress Bar -->
                        <ul id="progressbar" class="justify-content-around d-flex">
                            <li class="active">Create person</li>
                            <li>Person relationship</li>
                            <li>Create user</li>

                        </ul>
                        <!-- Fieldsets -->
                        <fieldset id="first">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>

                            </div>
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="last_name" required>

                            </div>

                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="number" name="dni" class="form-control" id="dni" aria-describedby="dni" required>

                            </div>

                            <div class="form-group">
                                <label for="alias">Alias</label>
                                <input type="text" name="alias" class="form-control" id="alias" aria-describedby="alias" required>

                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="email" required>

                            </div>

                            <div class="form-group">
                                <label for="phone_number">Phone number</label>
                                <input type="number" name="phone_number" class="form-control" id="phone_number" aria-describedby="phone_number" required>

                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" aria-describedby="address" required>

                            </div>

                            <div class="form-group">
                                <label for="identification_code">Identification code</label>
                                <input type="number" name="identification_code" class="form-control" id="identification_code" aria-describedby="identification_code" required>

                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <select class="custom-select" name="country" id="">
                                    <option value="none">Select..</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->country_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="state">State</label>
                                <select class="custom-select" name="state" id="">
                                    <option value="none">Select..</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}">{{$state->state_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <select class="custom-select" name="city" id="">
                                    <option value="none">Select..</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                            <input class="next_btn btn btn-info" name="next" type="button" value="Next">
                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="relationship">Relationship</label>
                                <select class="custom-select" name="relationship" id="relationshipSelect4">
                                    <option value="none">Select..</option>
                                    <option value="1">Direct</option>
                                    <option value="2">Freelance</option>
                                </select>
                            </div>





                            <div id="relationForm4">






                            </div>



                            <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                            <input class="next_btn btn btn-info" name="next" type="button" value="Next">

                        </fieldset>
                        <fieldset>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" aria-describedby="username" required>
                            </div>

                            <input type="text" name="rol" id="rol" value="4" hidden>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" class="form-control" id="password" aria-describedby="password" required>
                            </div>

                            <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">

                            <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        </fieldset>

                        </form>
                </div>


              </div>
            </div>
          </div>


<!-- Modal Relation Direct -->
<div class="modal fade" id="relationships" tabindex="-1" role="dialog" aria-labelledby="relationshipsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="relationshipsTitle">New Direct relationship</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" action="/Admin/Relationships/Direct/Add" method="POST">
                @csrf
            <div class="form-group">
                <label for="person">Person</label>
                <select class="custom-select" name="person" id="">
                    <option value="none">Select..</option>
                    @foreach ($persons as $person)
                        <option value="{{$person->id}}">{{$person->alias}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="company_labor_relationship">Company labor relationship</label>
                <input type="text" name="company_labor_relationship" class="form-control" id="company_labor_relationship" aria-describedby="company_labor_relationship" >

            </div>
            <div class="form-group">
                <label for="social_work">Social work</label>
                <input type="text" name="social_work" class="form-control" id="social_work" aria-describedby="social_work" >

            </div>
            <div class="form-group">
                <label for="labor_union">Labor union</label>
                <input type="text" name="labor_union" class="form-control" id="labor_union" aria-describedby="labor_union" >

            </div>



            <div class="form-group">
                <label for="ivaCondition">IVA Condition</label>
                <input type="text" name="ivaCondition" class="form-control" id="ivaCondition" aria-describedby="ivaCondition" >

            </div>
            <div class="form-group">
                <label for="account_bank">Account bank</label>
                <input type="text" name="account_bank" class="form-control" id="account_bank" aria-describedby="account_bank" >

            </div>
            <div class="form-group">
                <label for="account_number">Account number</label>
                <input type="text" name="account_number" class="form-control" id="account_number" aria-describedby="account_number" >

            </div>

            <div class="form-group">
                <label for="cbu_number">CBU</label>
                <input type="text" name="cbu_number" class="form-control" id="cbu_number" aria-describedby="cbu_number" >

            </div>
            <div class="form-group">
                <label for="familyContact_name">Family contact name</label>
                <input type="text" name="familyContact_name" class="form-control" id="familyContact_name" aria-describedby="familyContact_name" >

            </div>
            <div class="form-group">
                <label for="familyContact_phoneNumber">Family contact phone number</label>
                <input type="text" name="familyContact_phoneNumber" class="form-control" id="familyContact_phoneNumber" aria-describedby="familyContact_phoneNumber" >

            </div>
            <div class="form-group">
                <label for="familyContact_address">Family contact address</label>
                <input type="text" name="familyContact_address" class="form-control" id="familyContact_address" aria-describedby="familyContact_address" >

            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
        </div>

      </div>
    </div>
  </div>



          <!-- Modal Freelance-->
          <div class="modal fade" id="directRelation" tabindex="-1" role="dialog" aria-labelledby="directRelationTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="directRelationTitle">New Freelance relation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form autocomplete="off" action="/Admin/Relationships/Freelance/Add" method="POST">
                            @csrf
                        <label for="person">Person</label>
                        <select class="custom-select" name="person" id="">
                            <option value="none">Select..</option>
                            @foreach ($persons as $person)
                                <option value="{{$person->id}}">{{$person->alias}}</option>
                            @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="ivaCondition2">IVA Condition</label>
                        <input type="text" name="ivaCondition2" class="form-control" id="ivaCondition2" aria-describedby="ivaCondition2" >

                    </div>
                    <div class="form-group">
                        <label for="account_bank2">Account bank</label>
                        <input type="text" name="account_bank2" class="form-control" id="account_bank2" aria-describedby="account_bank2" >

                    </div>
                    <div class="form-group">
                        <label for="account_number2">Account number</label>
                        <input type="text" name="account_number2" class="form-control" id="account_number2" aria-describedby="account_number2" >

                    </div>

                    <div class="form-group">
                        <label for="cbu_number2">CBU</label>
                        <input type="text" name="cbu_number2" class="form-control" id="cbu_number2" aria-describedby="cbu_number2" >

                    </div>
                    <div class="form-group">
                        <label for="familyContact_name2">Family contact name</label>
                        <input type="text" name="familyContact_name2" class="form-control" id="familyContact_name2" aria-describedby="familyContact_name2" >

                    </div>
                    <div class="form-group">
                        <label for="familyContact_phoneNumber2">Family contact phone number</label>
                        <input type="text" name="familyContact_phoneNumber2" class="form-control" id="familyContact_phoneNumber2" aria-describedby="familyContact_phoneNumber2" >

                    </div>
                    <div class="form-group">
                        <label for="familyContact_address">Family contact address</label>
                        <input type="text" name="familyContact_address2" class="form-control" id="familyContact_address2" aria-describedby="familyContact_address2" >

                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                </form>
                </div>


              </div>
            </div>
          </div>



                      <!-- Modal Person Client-->
                      <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalScrollableTitle">New Person CLient</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#clientNPerson">
                                    New Person
                                  </button>
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#clientFPerson">
                                    From Person
                                  </button>
                            </div>

                          </div>
                        </div>
                      </div>


                       <!-- Modal -->
                       <div class="modal fade" id="clientFPerson" tabindex="-1" role="dialog" aria-labelledby="clientFPersonTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="clientFPersonTitle">New Person CLient</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form autocomplete="off" action="/Admin/addClientsPersons" id="clientPersonForm" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name" aria-describedby="name">

                                      </div>
                                      <div class="form-group">
                                        <label for="person">Person</label>
                                        <select class="custom-select" name="person" id="">
                                            <option value="none">Select..</option>
                                            @foreach ($persons as $person)
                                                <option value="{{$person->id}}">{{$person->alias}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                      </div>
                                </form>
                            </div>

                          </div>
                        </div>
                      </div>
                       <!-- Modal -->
                       <div class="modal fade" id="clientNPerson" tabindex="-1" role="dialog" aria-labelledby="clientNPersonTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="clientNPersonTitle">New Person CLient</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form autocomplete="off" action="/Admin/addClientsPersons" class="regform" method="POST">
                                    @csrf
                                    <!-- Progress Bar -->
                                    <ul id="progressbar" class="justify-content-around d-flex">
                                        <li class="active">Create person</li>
                                        <li>Freelance info</li>
                                        <li>Create client</li>

                                    </ul>
                                    <!-- Fieldsets -->
                                    <fieldset id="first">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" id="name" aria-describedby="name" required>

                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last name</label>
                                            <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="last_name" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="dni">DNI</label>
                                            <input type="number" name="dni" class="form-control" id="dni" aria-describedby="dni" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="alias">Alias</label>
                                            <input type="text" name="alias" class="form-control" id="alias" aria-describedby="alias" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" aria-describedby="email" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="phone_number">Phone number</label>
                                            <input type="number" name="phone_number" class="form-control" id="phone_number" aria-describedby="phone_number" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" class="form-control" id="address" aria-describedby="address" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="identification_code">Identification code</label>
                                            <input type="number" name="identification_code" class="form-control" id="identification_code" aria-describedby="identification_code" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select class="custom-select" name="country" id="">
                                                <option value="none">Select..</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select class="custom-select" name="state" id="">
                                                <option value="none">Select..</option>
                                                @foreach ($states as $state)
                                                    <option value="{{$state->id}}">{{$state->state_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <select class="custom-select" name="city" id="">
                                                <option value="none">Select..</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                                        <input class="next_btn btn btn-info" name="next" type="button" value="Next">
                                    </fieldset>
                                    <fieldset>






                                        <div id="relationship">
                                            <div class="form-group">
                                                <label for="ivaCondition2">IVA Condition</label>
                                                <input type="text" name="ivaCondition2" class="form-control" id="ivaCondition2" aria-describedby="ivaCondition2" >

                                            </div>
                                            <div class="form-group">
                                                <label for="account_bank2">Account bank</label>
                                                <input type="text" name="account_bank2" class="form-control" id="account_bank2" aria-describedby="account_bank2" >

                                            </div>
                                            <div class="form-group">
                                                <label for="account_number2">Account number</label>
                                                <input type="text" name="account_number2" class="form-control" id="account_number2" aria-describedby="account_number2" >

                                            </div>

                                            <div class="form-group">
                                                <label for="cbu_number2">CBU</label>
                                                <input type="text" name="cbu_number2" class="form-control" id="cbu_number2" aria-describedby="cbu_number2" >

                                            </div>
                                            <div class="form-group">
                                                <label for="familyContact_name2">Family contact name</label>
                                                <input type="text" name="familyContact_name2" class="form-control" id="familyContact_name2" aria-describedby="familyContact_name2" >

                                            </div>
                                            <div class="form-group">
                                                <label for="familyContact_phoneNumber2">Family contact phone number</label>
                                                <input type="text" name="familyContact_phoneNumber2" class="form-control" id="familyContact_phoneNumber2" aria-describedby="familyContact_phoneNumber2" >

                                            </div>
                                            <div class="form-group">
                                                <label for="familyContact_address">Family contact address</label>
                                                <input type="text" name="familyContact_address2" class="form-control" id="familyContact_address2" aria-describedby="familyContact_address2" >

                                            </div>





                                        </div>



                                        <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">
                                        <input class="next_btn btn btn-info" name="next" type="button" value="Next">

                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="clientName">Client name</label>
                                            <input type="text" name="clientName" class="form-control" id="clientName" aria-describedby="clientName" required>
                                        </div>




                                        <input class="pre_btn btn btn-info" name="previous" type="button" value="Previous">

                                        <button type="submit" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                    </fieldset>

                                    </form>
                            </div>

                          </div>
                        </div>
                      </div>





    </main>
@endsection

@section('scripts')
    <script src="{{asset('js/adminFunctions.js')}}"></script>
    <script>















        $(document).ready(function() {
var count = 0; // To Count Blank Fields

/*---------------------------------------------------------*/
$(".next_btn").click(function() { // Function Runs On NEXT Button Click
$(this).parent().next().fadeIn('slow');
$(this).parent().css({
'display': 'none'
});
// Adding Class Active To Show Steps Forward;
$('.active').next().addClass('active');
});
$(".pre_btn").click(function() { // Function Runs On PREVIOUS Button Click
$(this).parent().prev().fadeIn('slow');
$(this).parent().css({
'display': 'none'
});
// Removing Class Active To Show Steps Backward;
$('.active:last').removeClass('active');
});
// Validating All Input And Textarea Fields
$(".submit_btn").click(function(e) {
if ($('input').val() == "" || $('textarea').val() == "") {
alert("*All Fields are mandatory*");
return false;
} else {
return true;
}
});
});
    </script>
@endsection
