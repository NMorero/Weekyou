<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Clients;
use App\Companies;
use App\Countries;
use App\Persons;
use App\Developers;
use App\DirectRelationships;
use App\FreelanceRelationships;
use App\Images;
use App\PRLeaders;
use App\ProjectDevelopers;
use App\ProjectLeaders;
use App\ProjectManagers;
use App\Projects;
use App\ProjectViews;
use App\Relationships;
use App\Roles;
use App\States;
use App\User;
use App\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;


// include composer autoload
require '../vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

// configure with favored image driver (gd by default)
Image::configure(array('driver' => 'imagick'));


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $userId = Auth::id();
            $user = User::find($userId);

            if ($user->roles->rol !== 'admin') {
                return abort(401);
            }
            return $next($request);
        })->except(['pageProjects', 'pageViews', 'getProjects', 'acProject', 'desProject']);
    }





    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getRole(){
        $user = [
            0 => auth()->user()->roles->rol,
            1 => auth()->user()->person->name,
            2 => auth()->user()->person->last_name
        ];
        return $user;
    }

    public function deleteDB()
    {
        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        Schema::disableForeignKeyConstraints();
        foreach ($tableNames as $name) {
            //if you don't want to truncate migrations
            if ($name == 'migrations') {
                continue;
            }
            DB::table($name)->truncate();
        }
        Schema::enableForeignKeyConstraints();
    }


    public function deleteProject($id)
    {
        $project = Projects::find($id);
        $project->delete();
        return redirect('/Admin/Projects');
    }

    public function deleteView($id)
    {
        $viewProject = ProjectViews::where('view_id', 'LIKE', $id)->get();
        $view = Views::find($id);
        $viewProject[0]->delete();
        $view->delete();
        return  back();
    }



    public function home()
    {

        $persons = Persons::all();
        $companies = Companies::all();
        $countries = Countries::all();
        $cities = Cities::all();
        $states = States::all();
        $users = User::all();
        $roles = Roles::all();
        $clients = Clients::all();
        $managers = ProjectManagers::all();
        $leaders = ProjectLeaders::all();

        foreach ($managers as $manager) {
            $user = User::find($manager->user_id);
            $manager['name'] = $user->username;
        }

        foreach ($leaders as $leader) {
            $user = User::find($leader->user_id);
            $leader['name'] = $user->username;
        }


        $vac = compact('persons', 'companies', 'countries', 'cities', 'states', 'users', 'roles', 'clients', 'managers', 'leaders');
        return view('adminHome', $vac);
    }

    public function pageClientsPersons()
    {
        $clients = Clients::whereNotNull('person_id')->get();

        $vac = compact('clients');
        return view('layouts.admin.clientsPersons', $vac);
    }

    public function pageClientsCompany()
    {
        $clients = Clients::whereNotNull('company_id')->get();
        $vac = compact('clients');
        return view('layouts.admin.clientsCompanyTable', $vac);
    }

    public function updateCompany(Request $request, $id)
    {
        $company = Companies::find($id);
        $company->name = $request['name'];
        $company->cuit = $request['cuit'];
        $company->alias = $request['alias'];
        $company->website = $request['website'];
        $company->administrator_name = $request['adminName'];
        $company->administrator_email = $request['adminEmail'];
        $company->production_manager_name = $request['prodManName'];
        $company->production_email = $request['prodEmail'];
        $company->phone_number = $request['phoneNumber'];
        $company->address = $request['address'];
        $company->postal_code = $request['postalCode'];
        $company->identification_code = $request['identificationCode'];
        $company->save();
        return redirect('/Admin/Companies');
    }


    public function updateClientperson(Request $request, $id)
    {
        $client = Clients::find($id);
        $client->client_name = $request['client_name'];
        $client->type = $request['client_type'];
        $client->save();
        return redirect('/Admin/Clients/Person');
    }

    public function addClientsPersons(Request $request)
    {


        $freelanceRel = new FreelanceRelationships;
        $freelanceRel->iva_condition = $request['ivaCondition2'];
        $freelanceRel->account_bank = $request['account_bank2'];
        $freelanceRel->account_number = $request['account_number2'];
        $freelanceRel->cbu_number = $request['cbu_number2'];
        $freelanceRel->familyContact_name = $request['familyContact_name2'];
        $freelanceRel->familyContact_phoneNumber = $request['familyContact_phoneNumber2'];
        $freelanceRel->familyContact_address = $request['familyContact_address2'];

        $freelanceRel->save();
        $relation = new Relationships;
        $relation->freelance_id = $freelanceRel->id;
        $relation->save();
        $idRelation = $relation->id;





        $person = new Persons;
        $person->name = $request['name'];
        $person->last_name = $request['last_name'];
        $person->dni = $request['dni'];
        $person->alias = $request['alias'];
        $person->email = $request['email'];
        $person->phone_number = $request['phone_number'];
        $person->address = $request['address'];
        $person->identification_code = $request['identification_code'];
        $person->country_id = $request['country'];
        $person->state_id = $request['state'];
        $person->city_id = $request['city'];
        $person->relationship_id = $idRelation;
        $person->save();







        $client = new Clients;
        $client->client_name = $request['clientName'];
        $client->type = 'Freelancer';
        $client->person_id = $person->id;
        $client->company_id = NULL;
        $client->save();
        return redirect('/Admin/Clients/Person');
    }

    public function addClientsCompany(Request $request)
    {
        $client = new Clients;
        $client->client_name = $request['name'];
        $client->type = 'Company';
        $client->person_id = NULL;
        $client->company_id = $request['company'];
        $client->save();
        return redirect('/Admin/Clients/Company');
    }

    public function getCompaniesTable()
    {
        $companies = Companies::all();
        $vac = compact('companies');
        return view('layouts.admin.companiesTable', $vac);
    }

    public function deleteCompany($id)
    {
        $company = Companies::find($id);
        $company->delete();

        return redirect('/Admin/Companies');
    }

    public function addCompany(Request $request)
    {
        $company = new Companies;
        $company->name = $request['name'];
        $company->cuit = $request['cuit'];
        $company->alias = $request['alias'];
        $company->website = $request['website'];
        $company->administrator_name = $request['adminName'];
        $company->administrator_email = $request['adminEmail'];
        $company->production_manager_name = $request['prodManName'];
        $company->production_email = $request['prodEmail'];
        $company->phone_number = $request['phoneNumber'];
        $company->address = $request['address'];
        $company->postal_code = $request['postalCode'];
        $company->identification_code = $request['identificationCode'];
        $company->country_id = $request['country'];
        $company->state_id = $request['state'];
        $company->city_id = $request['city'];

        $company->save();
        return redirect('/Admin/Companies');
    }

    public function pageDevelopers()
    {
        $developers = Developers::all();
        foreach ($developers as $developer) {
            $user = User::find($developer->user_id);
            $person = Persons::find($user->person_id);
            $developer['person'] = $person;
            $developer['username'] = $user['username'];
        }

        $vac = compact('developers');
        return view('layouts.admin.developersTable', $vac);
    }

    public function deleteDeveloper($id)
    {
        $dev = Developers::find($id);
        $dev->delete();
        return redirect('/Admin/Developers');
    }

    public function addDeveloper(Request $request)
    {
        $developer = new Developers;
        $developer->user_id = $request['user'];

        $developer->save();

        return redirect('/Admin/Developers');
    }

    public function pagePersons()
    {
        $persons = Persons::orderBy('identification_code')->get();
        $vac = compact('persons');
        return view('layouts.admin.personsTable', $vac);
    }

    public function updatePerson(Request $request, $id)
    {
        $person = Persons::find($id);
        $person->name = $request['name'];
        $person->last_name = $request['last_name'];
        $person->dni = $request['dni'];
        $person->alias = $request['alias'];
        $person->email = $request['email'];
        $person->phone_number = $request['phone_number'];
        $person->address = $request['address'];
        $person->identification_code = $request['identification_code'];

        $person->save();

        return redirect('/Admin/Persons');
    }

    public function deletePerson($id)
    {
        $person = Persons::find($id);
        $person->delete();
        return redirect('/Admin/Persons');
    }

    public function addPerson(Request $request)
    {
        $person = new Persons;
        $person->name = $request['name'];
        $person->last_name = $request['last_name'];
        $person->dni = $request['dni'];
        $person->alias = $request['alias'];
        $person->email = $request['email'];
        $person->phone_number = $request['phone_number'];
        $person->address = $request['address'];
        $person->identification_code = $request['identification_code'];
        $person->country_id = $request['country'];
        $person->state_id = $request['state'];
        $person->city_id = $request['city'];
        $person->save();

        return redirect('/Admin/Persons');
    }


    public function addPRManager(Request $request)
    {
        $PRManager = new ProjectManagers;
        $PRManager->user_id = $request['user'];
        $PRManager->save();

        return redirect('/Admin/Projects/Managers');
    }

    public function addPRLeader(Request $request)
    {
        $PRLeader = new ProjectLeaders;
        $PRLeader->user_id = $request['user'];
        $PRLeader->save();

        return redirect('/Admin/Projects/Leaders');
    }

    public function deleteLeader($id)
    {
        $leader = PRLeaders::find($id);
        $leader->delete();

        return redirect('/Admin/Projects/Leaders');
    }


    public function pagePRLeaders()
    {
        $PRLeaders = ProjectLeaders::all();

        foreach ($PRLeaders as $leader) {
            $user = User::find($leader->user_id);
            $person = Persons::find($user->person_id);
            $leader['user'] = $user;
            $leader['person'] = $person;
        }



        $vac = compact('PRLeaders');
        return view('layouts.admin.PRLeadersTable', $vac);
    }

    public function pagePRManagers()
    {
        $PRManagers = ProjectManagers::all();

        foreach ($PRManagers as $manager) {
            $user = User::find($manager->user_id);
            $person = Persons::find($user->person_id);
            $manager['user'] = $user;
            $manager['person'] = $person;
        }


        $vac = compact('PRManagers');
        return view('layouts.admin.PRManagersTable', $vac);
    }

    public function deletePRManager($id)
    {
        $manager = ProjectManagers::find($id);
        $manager->delete();

        return redirect('/Admin/Managers/Delete/{id}');
    }

    public function addUser(Request $request)
    {
        //return $request;
        if ($request['relationship'] == 1) {
            $directRel = new DirectRelationships;
            $directRel->company_labor_relationship = $request['company_labor_relationship'];
            $directRel->social_work = $request['social_work'];
            $directRel->labor_union = $request['labor_union'];

            $directRel->iva_condition = $request['ivaCondition'];
            $directRel->account_bank = $request['account_bank'];
            $directRel->account_number = $request['account_number'];
            $directRel->cbu_number = $request['cbu_number'];
            $directRel->familyContact_name = $request['familyContact_name'];
            $directRel->familyContact_phoneNumber = $request['familyContact_phoneNumber'];
            $directRel->familyContact_address = $request['familyContact_address'];
            $directRel->save();
            $relation = new Relationships;
            $relation->direct_id = $directRel->id;
            $relation->save();
            $idRelation = $relation->id;
        } else if ($request['relationship'] == 2) {
            $freelanceRel = new FreelanceRelationships;
            $freelanceRel->iva_condition = $request['ivaCondition2'];
            $freelanceRel->account_bank = $request['account_bank2'];
            $freelanceRel->account_number = $request['account_number2'];
            $freelanceRel->cbu_number = $request['cbu_number2'];
            $freelanceRel->familyContact_name = $request['familyContact_name2'];
            $freelanceRel->familyContact_phoneNumber = $request['familyContact_phoneNumber2'];
            $freelanceRel->familyContact_address = $request['familyContact_address2'];

            $freelanceRel->save();
            $relation = new Relationships;
            $relation->freelance_id = $freelanceRel->id;
            $relation->save();
            $idRelation = $relation->id;
        }




        $person = new Persons;
        $person->name = $request['name'];
        $person->last_name = $request['last_name'];
        $person->dni = $request['dni'];
        $person->alias = $request['alias'];
        $person->email = $request['email'];
        $person->phone_number = $request['phone_number'];
        $person->address = $request['address'];
        $person->identification_code = $request['identification_code'];
        $person->country_id = $request['country'];
        $person->state_id = $request['state'];
        $person->city_id = $request['city'];
        $person->relationship_id = $idRelation;
        $person->save();


        $user = new User;
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->person_id = $person->id;
        $user->rol_id = $request['rol'];
        $user->save();


        if ($request['rol'] == '2') {
            $dev = new Developers;
            $dev->user_id = $user->id;
            $dev->save();
            return redirect('/Admin/Developers');
        } else if ($request['rol'] == 3) {
            $manager = new ProjectManagers;
            $manager->user_id = $user->id;
            $manager->save();
            return redirect('/Admin/Projects/Managers');
        } else if ($request['rol'] == 4) {
            $leader = new ProjectLeaders;
            $leader->user_id = $user->id;
            $leader->save();
            return redirect('/Admin/Projects/Leaders');
        }



        return redirect('/Admin/Users');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();

        return redirect('/Admin/Users');
    }

    public function pageUsers()
    {
        $users = User::all();

        foreach ($users as $user) {
            $person = Persons::find($user->person_id);
            $rol = Roles::find($user->rol_id);
            $user['person'] = $person;
            $user['rol'] = $rol;
        }


        $vac = compact('users');
        return view('layouts.admin.usersTable', $vac);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/Admin/Users');
    }
    public function updateProject($id, $status){
        if($status == 1){
            $project = Projects::find($id);
            $project->status = 'next';
            $project->save();
        }else if($status == 2){
            $project = Projects::find($id);
            $project->status = 'ongoing';
            $project->save();
        }else if($status == 3){
            $project = Projects::find($id);
            $project->status = 'atClient';
            $project->save();
        }else if($status == 4){
            $project = Projects::find($id);
            $project->status = 'pause';
            $project->save();
        }else if($status == 5){
            $project = Projects::find($id);
            $project->status = 'finished';
            $project->save();
        }
        return ['status' => 'ok'];
    }

    public function infoClientsLeadersManagers(){
        $clients = Clients::all();
        $managers = ProjectManagers::all();
        $leaders = ProjectLeaders::all();
        foreach($leaders as $lead){
            $user = User::find($lead->user_id);
            $person = Persons::find($user->person_id);
            $lead['username'] = $user->username;
            $lead['lastName'] = $person->last_name;
            $lead['name'] = $person->name;
        }
        foreach($managers as $man){
            $user = User::find($man->user_id);
            $person = Persons::find($user->person_id);
            $man['username'] = $user->username;
            $man['lastName'] = $person->last_name;
            $man['name'] = $person->name;
        }
        return ['clients' => $clients, 'managers' => $managers, 'leaders' => $leaders];
    }

    public function getProjects(){
        $id = Auth::user()->id;
        $projects = [];
        if (auth()->user()->roles->rol == 'developer'){

            $dev = Developers::where('user_id', 'LIKE', $id)->get();
            $devProjects = ProjectDevelopers::where('developer_id','LIKE',$dev[0]->id)->get();

            foreach($devProjects as $devProject){
                $project = Projects::find($devProject->project_id);
                    $projects[] = $project;
            }
        }else if(auth()->user()->roles->rol == 'PRleader'){
            $lead = ProjectLeaders::where('user_id', 'LIKE', $id)->get();
            $leadProjects = Projects::where('leader_id', 'LIKE', $lead[0]->id)->get();
            foreach($leadProjects as $leadProject){
                $project = Projects::find($leadProject->id);
                    $projects[] = $project;
            }
        }else if(auth()->user()->roles->rol == 'PRmanager'){
            $man = ProjectManagers::where('user_id', 'LIKE', $id)->get();
            $manProjects = Projects::where('manager_id', 'LIKE', $man[0]->id)->get();
            foreach($manProjects as $manProject){
                $project = Projects::find($manProject->id);
                    $projects[] = $project;
            }
        }else if(auth()->user()->roles->rol == 'admin'){
            $projects = Projects::all();
        }
        $views=[];

        foreach ($projects as $project) {
            $client = Clients::find($project->client_id);
            $manager = ProjectManagers::find($project->manager_id);
            $user1 = User::find($manager->user_id);
            $leader = ProjectLeaders::find($project->leader_id);
            $user2 = User::find($leader->user_id);
            $devPros = ProjectDevelopers::where('project_id', 'LIKE', $project->id)->get();

            $devs = [];
            $devsLists = [];
            $i = 0;
            foreach($devPros as $devPro){
                $i++;
                $dev = Developers::find($devPro->developer_id);
                $userDev = User::find($dev->user_id);
                $devs[] = [
                    'module' => $devPro->module,
                    'developer' => $userDev->person->name
                ];
                if(array_key_exists($devPro->list_name, $devsLists)){
                     array_push($devsLists[$devPro->list_name]['modules'],[
                         'id' => $i,
                        'module' => $devPro->module,
                        'list_name' => $devPro->list_name,
                        'developer' => substr($userDev->person->name,0, 1) . substr($userDev->person->last_name,0, 1)
                    ]);
                }else{
                    $devsLists[$devPro->list_name] = [
                        'id' => $i,
                        'name' => $devPro->list_name,
                        'modules' => []
                    ];
                    array_push($devsLists[$devPro->list_name]['modules'],[
                        'id' => $i,
                        'module' => $devPro->module,
                        'list_name' => $devPro->list_name,
                        'developer' => substr($userDev->person->name,0, 1) . substr($userDev->person->last_name,0, 1)
                    ]);
                }
            }
            $project['devs'] = [
                'devs' => $devs,
                'devsLists' => $devsLists
            ];

            $views = [];
            $viewsPR = ProjectViews::where('project_id', 'LIKE', $project->id)->get();
            $n = 0;
            foreach($viewsPR as $viewPR){
                $n++;
                $viewT = Views::find($viewPR->view_id);
                $image = Images::find($viewT->image_id);
                $views[] = [
                    'id' => $n,
                    'img' => $image->image_route,
                    'title' => $viewPR->view_title
                ];
            }

            $personMan = Persons::find($user1->person_id);
            $nameMan = $personMan->name;
            $lastnameMan = $personMan->last_name;

            $personLea = Persons::find($user2->person_id);
            $nameLea = $personLea->name;
            $lastnameLea = $personLea->last_name;

            $project['views'] = $views;
            $project['client'] = $client->client_name;
            $project['manager'] = [
                'name' => $nameMan,
                'lastname' => $lastnameMan
            ];
            $project['leader'] = [
                'name' => $nameLea,
                'lastname' => $lastnameLea
            ];
        }

        $projectFinal = [];
        $projectNext = [];
        $projectOngoing = [];
        $projectAtClient = [];
        $projectSuspended = [];
        $projectFinished = [];
        foreach($projects as $proj){
            if($proj['status'] == 'ongoing'){
                $projectOngoing[] = $proj;
            }else if($proj['status'] == 'next'){
                $projectNext[] = $proj;
            }else if($proj['status'] == 'atClient'){
                $projectAtClient[] = $proj;
            }else if($proj['status'] == 'pause'){
                $projectSuspended[] = $proj;
            }else if($proj['status'] == 'finished'){
                $projectFinished[] = $proj;
            }
        }
        $projectFinal[0] = $projectNext;
        $projectFinal[1] = $projectOngoing;
        $projectFinal[2] = $projectAtClient;
        $projectFinal[3] = $projectSuspended;
        $projectFinal[4] = $projectFinished;
        $projectsAll = [
            0 => $projectFinal,
            1 => $projects
        ];
        return $projectsAll;
    }

    public function getDevelopers(){
        $devs = Developers::all();
        foreach($devs as $dev){
            $user = User::find($dev->user_id);
            $dev['user'] = $user->username;
        }
        return $devs;
    }
    public function acProject($id){
        $project = Projects::find($id);
        $project->status = 'ongoing';
        $project->save();

        return ['status'=>'ok'];
    }

    public function desProject($id){
        $project = Projects::find($id);
        $project->status = 'pause';
        $project->save();

        return ['status'=>'ok'];
    }


    public function pageProjects()
    {

        $projects = Projects::all();
        foreach ($projects as $project) {
            $client = Clients::find($project->client_id);
            $manager = ProjectManagers::find($project->manager_id);
            $user1 = User::find($manager->user_id);
            $leader = ProjectLeaders::find($project->leader_id);
            $user2 = User::find($leader->user_id);

            $personMan = Persons::find($user1->person_id);
            $nameMan = $personMan->name;
            $lastnameMan = $personMan->last_name;

            $personLea = Persons::find($user2->person_id);
            $nameLea = $personLea->name;
            $lastnameLea = $personLea->last_name;


            $project['client'] = $client->client_name;
            $project['manager'] = [
                'name' => $nameMan,
                'lastname' => $lastnameMan
            ];
            $project['leader'] = [
                'name' => $nameLea,
                'lastname' => $lastnameLea
            ];
        }

        $clients = Clients::all();
        $leaders = ProjectLeaders::all();
        $managers = ProjectManagers::all();
        foreach ($managers as $manager) {
            $user = User::find($manager->user_id);
            $manager['name'] = $user->username;
        }

        foreach ($leaders as $leader) {
            $user = User::find($leader->user_id);
            $leader['name'] = $user->username;
        }

        $developers = Developers::all();
        foreach($developers as $developer){
            $user = User::find($developer->user_id);
            $developer['name'] = $user->person->name;
        }
        $vac = compact('projects', 'clients', 'managers', 'leaders', 'developers');
        return view('layouts.admin.projects', $vac);
    }

    public function addModuleProject(Request $request){
        $id = $request['id'];

        $devPro = new ProjectDevelopers;
        $devPro->developer_id = $request['developer'];
        $devPro->project_id = $id;
        $devPro->module = $request['title'];
        $devPro->list_name = $request['list'];
        $devPro->save();
        return ['status' => 'ok'];
    }

    public function pageViews($id)
    {
        $views = ProjectViews::where('project_id', 'LIKE', $id)->get();
        foreach ($views as $view) {
            $image1 = Views::find($view->view_id);
            $image2 = Images::find($image1['image_id']);
            $view['image'] = $image2['image_route'];
        }
        $vac = compact('views', 'id');
        return view('layouts.admin.projectViews', $vac);
    }

    public function addProject(Request $request)
    {
        $project = new Projects;
        $project->project_name = $request['projectName'];
        $project->delivery_date = $request['projectDate'];
        $project->client_id = $request['projectClient'];
        $project->manager_id = $request['projectManager'];
        $project->leader_id = $request['projectLeader'];
        $project->alias = $request['projectAlias'];
        $project->status = 'next';

        if(isset($request['thumbnail']) && !empty($request['thumbnail'])){

            $imageName = date("Y-m-d") . '-' . time() . '.' . $request['thumbnail']->getClientOriginalExtension();

                $project->thumbnail ='/upload/posts/thumbnails/' . $imageName;;
                $img = $request->file('thumbnail')->getRealPath();

                $resized = Image::make($img);
                $width = $resized->width();
                $height = $resized->height();

                if(($width / $height) >= 1.77){
                    $resized->resize(478, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }else{
                    $resized->resize(null, 270, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                $resized->save('upload/posts/thumbnails/' . $imageName);
            }



        $project->save();

        return ['id' => $project->id, 'thumbnail' => $project->thumbnail];
    }

    public function addView(Request $request, $id)
    {
        $image = new Images;
        $imageName = date("Y-m-d") . '-' . time() . '.' . $request['image']->getClientOriginalExtension();
        $img = $request['image']->getRealPath();
            $resized = Image::make($img);
            $width = $resized->width();
            $height = $resized->height();

            $resized2 = Image::make($img);

            if(($width / $height) >= 1.77){
                $resized->resize(478, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $resized2->resize(1920, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }else{
                $resized->resize(null, 270, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $resized2->resize(null, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $resized->save('upload/views/thumbnails/' . $imageName, 100);
            $resized2->save('upload/views/' . $imageName, 100);


        $image->image_route = '/upload/views/thumbnails/' . $imageName;
        $image->image_original = 'upload/views/' . $imageName;
        $image->save();

        $view = new Views;
        $view->image_id = $image->id;
        $view->save();

        $projectView = new ProjectViews;
        $projectView->view_id = $view->id;
        $projectView->project_id = $id;
        $projectView->view_title = $request['title'];
        $projectView->save();

        return back();
    }

    public function pageRoles()
    {
        $roles = Roles::all();
        $vac = compact('roles');
        return view('layouts.admin.roles', $vac);
    }

    public function deleteRol($id)
    {
        $rol = Roles::find($id);
        $rol->delete();

        return redirect('/Admin/Roles');
    }

    public function addRol(Request $request)
    {
        $rol = new Roles;
        $rol->rol = $request['name'];
        $rol->save();

        return redirect('/Admin/Roles');
    }


    public function addRelationDirect(Request $request)
    {
        $directRel = new DirectRelationships;
        $directRel->company_labor_relationship = $request['company_labor_relationship'];
        $directRel->social_work = $request['social_work'];
        $directRel->labor_union = $request['labor_union'];

        $directRel->iva_condition = $request['ivaCondition'];
        $directRel->account_bank = $request['account_bank'];
        $directRel->account_number = $request['account_number'];
        $directRel->cbu_number = $request['cbu_number'];
        $directRel->familyContact_name = $request['familyContact_name'];
        $directRel->familyContact_phoneNumber = $request['familyContact_phoneNumber'];
        $directRel->familyContact_address = $request['familyContact_address'];
        $directRel->save();
        $relation = new Relationships;
        $relation->direct_id = $directRel->id;
        $relation->save();
        $idRelation = $relation->id;

        $person = Persons::find($request['person']);
        $person->relationship_id = $idRelation;
        $person->save();
        return redirect('/Admin/Persons');
    }

    public function addRelationFreelance(Request $request)
    {
        $freelanceRel = new FreelanceRelationships;
        $freelanceRel->iva_condition = $request['ivaCondition2'];
        $freelanceRel->account_bank = $request['account_bank2'];
        $freelanceRel->account_number = $request['account_number2'];
        $freelanceRel->cbu_number = $request['cbu_number2'];
        $freelanceRel->familyContact_name = $request['familyContact_name2'];
        $freelanceRel->familyContact_phoneNumber = $request['familyContact_phoneNumber2'];
        $freelanceRel->familyContact_address = $request['familyContact_address2'];

        $freelanceRel->save();
        $relation = new Relationships;
        $relation->freelance_id = $freelanceRel->id;
        $relation->save();
        $idRelation = $relation->id;
        $person = Persons::find($request['person']);
        $person->relationship_id = $idRelation;
        $person->save();
        return redirect('/Admin/Persons');
    }

    public function pageRelationFreelance()
    {
        $relations = Relationships::whereNotNull('freelance_id')->get();
        foreach ($relations as $relation) {
            $person = Persons::where('relationship_id', 'LIKE', $relation->id)->get();

            $relation['person'] = $person[0]->name;
        }
        $vac = compact('relations');
        return view('layouts.admin.freelanceRelationships', $vac);
    }
    public function pageRelationDirect()
    {
        $relations = Relationships::whereNotNull('direct_id')->get();
        foreach ($relations as $relation) {
            $person = Persons::where('relationship_id', 'LIKE', $relation->id)->get();

            $relation['person'] = $person[0]->name;
        }
        $vac = compact('relations');
        return view('layouts.admin.directRelationships', $vac);
    }
}
