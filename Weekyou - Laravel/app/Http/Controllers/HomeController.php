<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Deliveries;
use App\Developers;
use App\Events;
use App\Images;
use App\LeaderOfDeveloper;
use App\ManagerOfLeaders;
use App\Persons;
use App\Posts;
use App\PRLeaders;
use App\ProjectDevelopers;
use App\ProjectLeaders;
use App\ProjectManagers;
use App\Projects;
use App\ProjectViews;
use App\Reminders;
use App\RemindersPages;
use App\Tasks;
use App\Templates;
use App\Tickets;
use App\User;
use App\Views;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// include composer autoload
require '../vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

// configure with favored image driver (gd by default)
Image::configure(array('driver' => 'imagick'));

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = [];
        $id = Auth::user()->id;
        $flag = true;

        if (auth()->user()->roles->rol == 'developer'){
            $dev = Developers::where('user_id', 'LIKE', $id)->get();
            $devProjects = ProjectDevelopers::where('developer_id','LIKE',$dev[0]->id)->get();

            foreach($devProjects as $devProject){
                $project = Projects::find($devProject->project_id);
                $client = Clients::find($project->client_id);
                foreach($clients as $cl){
                    if($cl->id == $client->id){
                        $flag = false;
                    }
                }
                if($flag){
                    $clients[] = $client;
                }
                $flag = true;
            }
        }else if(auth()->user()->roles->rol == 'PRleader'){
            $lead = ProjectLeaders::where('user_id', 'LIKE', $id)->get();

            $leadProjects = Projects::where('leader_id', 'LIKE', $lead[0]->id)->get();
            foreach($leadProjects as $leadProject){
                $project = Projects::find($leadProject->id);
                $client = Clients::find($project->client_id);
                foreach($clients as $cl){
                    if($cl->id == $client->id){
                        $flag = false;
                    }
                }
                if($flag){
                    $clients[] = $client;
                }
                $flag = true;
            }
        }else if(auth()->user()->roles->rol == 'PRmanager'){
            $man = ProjectManagers::where('user_id', 'LIKE', $id)->get();
            $manProjects = Projects::where('manager_id', 'LIKE', $man[0]->id)->get();
            foreach($manProjects as $manProject){
                $project = Projects::find($manProject->id);
                $client = Clients::find($project->client_id);
                foreach($clients as $cl){
                    if($cl->id == $client->id){
                        $flag = false;
                    }
                }
                if($flag){
                    $clients[] = $client;
                }
                $flag = true;
            }
        }else if(auth()->user()->roles->rol == 'admin'){
            $clients = Clients::all();
        }





        $vac = compact('clients');
        return view('home', $vac);
    }

    public function addTicket(Request $request){
        return $request;
        $ticket = new Tickets;
        $ticket->message = $request['data'];

    }


    public function test()
    {
        $clients = Clients::all();
        $vac = compact('clients');
        return view('test', $vac);
    }

    public function getProjectsByClient($client)
    {
        $id = Auth::user()->id;
        $projects = [];
        if (auth()->user()->roles->rol == 'developer'){

            $dev = Developers::where('user_id', 'LIKE', $id)->get();
            $devProjects = ProjectDevelopers::where('developer_id','LIKE',$dev[0]->id)->get();
            foreach($devProjects as $devProject){
                $project = Projects::find($devProject->project_id);
                if($project->client_id == $client){
                    $projects[] = $project;
                }
            }
        }else if(auth()->user()->roles->rol == 'PRleader'){
            $lead = ProjectLeaders::where('user_id', 'LIKE', $id)->get();
            $leadProjects = Projects::where('leader_id', 'LIKE', $lead[0]->id)->get();
            foreach($leadProjects as $leadProject){
                $project = Projects::find($leadProject->id);
                if($project->client_id == $client){
                    $projects[] = $project;
                }

            }
        }else if(auth()->user()->roles->rol == 'PRmanager'){
            $man = ProjectManagers::where('user_id' , 'LIKE' , $id)->get();
            $manProjects = Projects::where('manager_id', 'LIKE', $man[0]->id)->get();
            foreach($manProjects as $manProject){
                $project = Projects::find($manProject->id);
                if($project->client_id == $client){
                    $projects[] = $project;
                }
            }
        }else if(auth()->user()->roles->rol == 'admin'){
            $projects = Projects::where('client_id', 'LIKE', $client)->get();
        }

        return $projects;
    }

    public function getViewsByProject($project)
    {
        $views = ProjectViews::where('project_id', 'LIKE', $project)->get();
        return $views;
    }

    public function getPosts($client, $project, $view)
    {

        $posts = [];
        $id = Auth::user()->id;
        if ($client === 'All') {
            if (auth()->user()->roles->rol == 'developer'){

                $dev = Developers::where('user_id', 'LIKE', $id)->get();
                $devProjects = ProjectDevelopers::where('developer_id','LIKE',$dev[0]->id)->get();
                foreach($devProjects as $devProject){
                    $project = Projects::find($devProject->project_id);
                    $post = Posts::where('project_id', 'LIKE', $project->id)->orderBy('id', 'DESC')->paginate(25);
                    foreach($post as $po){
                        $posts[$po->id] = $po;
                    }
                }


            }else if(auth()->user()->roles->rol == 'PRleader'){
                $lead = ProjectLeaders::where('user_id', 'LIKE', $id)->get();
                $leadProjects = Projects::where('leader_id', 'LIKE', $lead[0]->id)->get();
                foreach($leadProjects as $leadProject){
                    $project = Projects::find($leadProject->id);
                    $post = Posts::where('project_id', 'LIKE', $project->id)->orderBy('id', 'DESC')->paginate(25);
                    foreach($post as $po){
                        $posts[$po->id] = $po;
                    }

                }
            }else if(auth()->user()->roles->rol == 'PRmanager'){
                $man = ProjectManagers::where('user_id', 'LIKE', $id)->get();
                $manProjects = Projects::where('manager_id', 'LIKE', $man[0]->id)->get();
                foreach($manProjects as $manProject){
                    $project = Projects::find($manProject->id);
                    $post = Posts::where('project_id', 'LIKE', $project->id)->orderBy('id', 'DESC')->paginate(25);
                    foreach($post as $po){
                        $posts[$po->id] = $po;
                    }
                }
            }else if(auth()->user()->roles->rol == 'admin'){
                $post = Posts::orderBy('id', 'DESC')->paginate(25);
                foreach($post as $po){
                    $posts[$po->id] = $po;
                }
            }

        } else {
            if ($project === 'All') {
                if (auth()->user()->roles->rol == 'developer'){

                    $dev = Developers::where('user_id', 'LIKE', $id)->get();
                    $devProjects = ProjectDevelopers::where('developer_id','LIKE',$dev[0]->id)->get();
                    foreach($devProjects as $devProject){
                        $project = Projects::find($devProject->project_id);
                        $post = Posts::where('project_id', 'LIKE', $project->id)->where('client_id', 'LIKE', $client)->orderBy('id', 'DESC')->paginate(25);
                        foreach($post as $po){
                            $posts[$po->id] = $po;
                        }
                    }

                }else if(auth()->user()->roles->rol == 'PRleader'){
                    $lead = ProjectLeaders::where('user_id', 'LIKE', $id)->get();
                    $leadProjects = Projects::where('leader_id', 'LIKE', $lead[0]->id)->get();
                    foreach($leadProjects as $leadProject){
                        $project = Projects::find($leadProject->id);
                        $post = Posts::where('project_id', 'LIKE', $project->id)->where('client_id', 'LIKE', $client)->orderBy('id', 'DESC')->paginate(25);
                        foreach($post as $po){
                            $posts[$po->id] = $po;
                        }

                    }
                }else if(auth()->user()->roles->rol == 'PRmanager'){
                    $man = ProjectManagers::where('user_id', 'LIKE', $id)->get();
                    $manProjects = Projects::where('manager_id', 'LIKE', $man[0]->id)->get();
                    foreach($manProjects as $manProject){
                        $project = Projects::find($manProject->id);
                        $post = Posts::where('project_id', 'LIKE', $project->id)->where('client_id', 'LIKE', $client)->orderBy('id', 'DESC')->paginate(25);
                        foreach($post as $po){
                            $posts[$po->id] = $po;
                        }
                    }
                }else if(auth()->user()->roles->rol == 'admin'){
                    $posts = Posts::where('client_id', 'LIKE', $client)->orderBy('id', 'DESC')->paginate(25);
                }

            } else {
                if ($view === 'All') {
                    $post = Posts::where('client_id', 'LIKE', $client)->where('project_id', 'LIKE', $project)->orderBy('id', 'DESC')->paginate(25);
                    foreach($post as $po){
                        $posts[$po->id] = $po;
                    }
                } else {
                    $post = Posts::where('client_id', 'LIKE', $client)->where('project_id', 'LIKE', $project)->where('view_id', 'LIKE', $view)->orderBy('id', 'DESC')->paginate(25);
                    foreach($post as $po){
                        $posts[$po->id] = $po;
                    }
                }
            }
        }




        foreach ($posts as $post) {
            $user = User::find($post['user_id']);
            $post['user_name'] = $user['username'];

            if (isset($post->feedback)) {
                $post['feedback'] = $post->feedback;
            }

            $client = Clients::find($post->client_id);
            $post['client'] = $client->client_name;

            $project = Projects::find($post['project_id']);

            $post['project'] = $project->project_name;

            $project = Projects::find($post['project_id']);
            $post['project_name'] = $project['project_name'];


            $date = $post['created_at'];

            $time = date('H:i', strtotime($date));
            $post['time'] = $time;
            $date = date('d-m-y', strtotime($post['created_at']));
            //Print out the day that our date fell on.
            $post['date'] = $date;
        }
        return $posts;
    }

    public function deleteTask($id, $comm){
        $task = Tasks::find($id);
        $comments = json_decode($task->message);
        if(count($comments) == 1){
            $task->delete();
        }else{
            for($i = 0; $i < count($comments); $i++){
                if($comments[$i]->id == $comm){
                    unset($comments[$i]);
                    $task->message = json_encode($comments);
                    $task->save();
                    return ['status' => 'ok'];
                }
            }
        }
        return ['status' => 'ok'];
    }
    public function changePageName($data)
    {
        $data = json_decode($data, true);
        $page = RemindersPages::find($data['id']);
        $page->title = $data['title'];
        $page->save();
        return 'ok';
    }
    public function getReminders()
    {
        $pages = [];
        $id = Auth::user()->id;
        $pagesDb = RemindersPages::where('user_id', 'LIKE', $id)->get();
        foreach ($pagesDb as $page){
            $newPage = [
                "id" => $page->id,
                "page" => $page->page_number,
                "reminders" => [],
                "title" => $page->title
            ];
            array_push($pages, $newPage);
        }
        $reminders = Reminders::where('user_id', 'LIKE', $id)->orderBy('order')->get();
        $i = 0;
        foreach ($pages as $page){
            foreach ($reminders as $reminder){
                if ($page['page'] == $reminder->page) {
                    array_push($pages[$i]['reminders'], $reminder);
                }
            }
            $i++;
        }
        return $pages;
    }
    public function deleteReminder($id)
    {
        $reminder = Reminders::find($id);
        $reminder->delete();

        return ['status' => 'ok'];
    }

    public function addReminderPage($data)
    {
        $data = json_decode($data, true);
        $id = Auth::user()->id;
        $page = new RemindersPages;
        $page->title = $data['title'];
        $page->user_id = $id;
        $page->page_number = $data['page_number'];
        $page->save();
        return 'ok';
    }

    public function changeTask($task, $comment)
    {
        $taskDB = Tasks::find($task);
        $comments = json_decode($taskDB->message);
        foreach ($comments as $comm) {
            if ($comm->id == $comment) {
                if ($comm->status == 1) {
                    $comm->status = 2;

                    $taskDB->message = json_encode($comments);
                    $taskDB->save();
                    return $comments;
                } else if ($comm->status == 2) {
                    $comm->status = 1;
                    $taskDB->message = json_encode($comments);
                    $taskDB->save();
                    return $comments;
                }
            }
        }
    }







    public function getTasks()
    {

        $user = User::find(Auth::id());
        if ($user->rol_id == 1) {
            $tasksDB = Tasks::orderBy('end_date')->get();
        } else if ($user->rol_id == 2) {
            $tasksDB = Tasks::where('user_id', 'LIKE', Auth::id())->orderBy('end_date')->get();
        } else if ($user->rol_id == 3) {

            $leaders = [];

            $manager = ProjectManagers::where('user_id', 'LIKE', Auth::id())->get();
            $mleaders = $manager[0]->MLeaders;
            foreach ($mleaders as $mleader) {
                array_push($leaders, $mleader->leader);
            }
            $tasksDB = [];
            foreach ($leaders as $leader) {
                $tasksleader = Tasks::where('user_id', 'LIKE', $leader->user_id)->get();
                foreach ($tasksleader as $taskleader) {
                    $tasksDB[] = $taskleader;
                }
                $developers = [];
                $LDevelopers = $leader->LDevelopers;
                foreach ($LDevelopers as $LDeveloper) {
                    array_push($developers, $LDeveloper->developer);
                }

                foreach ($developers as $developer) {
                    $tasksDeveloper = Tasks::where('user_id', 'LIKE', $developer->user_id)->get();
                    foreach ($tasksDeveloper as $taskDev) {
                        $tasksDB[] = $taskDev;
                    }
                }
            }

            $tasksManager = Tasks::where('user_id', 'LIKE', $manager[0]->user_id)->get();
            foreach ($tasksManager as $taskManager) {
                $tasksDB[] = $taskManager;
            }
        } else if ($user->rol_id == 4) {
            $leader = ProjectLeaders::where('user_id', 'LIKE', Auth::id())->get();
            $leader = $leader[0];
            $developers = [];
            $LDevelopers = $leader->LDevelopers;
            foreach ($LDevelopers as $LDeveloper) {
                array_push($developers, $LDeveloper->developer);
            }
            $tasksDB = [];
            foreach ($developers as $developer) {
                $tasksDeveloper = Tasks::where('user_id', 'LIKE', $developer->user_id)->get();
                foreach ($tasksDeveloper as $taskDev) {
                    $tasksDB[] = $taskDev;
                }
            }
            $tasksLeader = Tasks::where('user_id', 'LIKE', $leader->user_id)->get();
            foreach ($tasksLeader as $taskLeader) {
                $tasksDB[] = $taskLeader;
            }
        }

        $events = Events::orderBy('end_date')->get();
        $tasks = [];
        $dates = [];

        foreach ($tasksDB as $task) {
            $task['user'] = $task->user;

                $task['project'] = $task->project;
                $task['client'] = $task->client->person;

            $endDate = $task->end_date;


        }
        $year = '2020';
        $ranges = array();
        $month = date('m');
        $d=cal_days_in_month(CAL_GREGORIAN,$month,$year);
        $start = strtotime($year.'-' . $month .'-01');
        $end = strtotime($year.'-'. $month .'-' . $d);
        $i2 = 1;
        for($i = 0; $i<=20; $i++){
            if($i==0){
                $da = date('Y-m-d', strtotime('today'));
                $ranges[] = $da;
            }else if($i <= 10){
                $da = date('Y-m-d', strtotime('+' . $i . ' days'));
                $ranges[] = $da;
            }else{
                $da = date('Y-m-d', strtotime('-' . $i2 . ' days'));
                $ranges[] = $da;
                $i2++;
            }

        }



        foreach($ranges as $range){
            if (!array_key_exists($range, $dates)) {
                array_push($dates, $range);
            }
        }

        foreach ($events as $event) {
            $event['client'] = $event->client;
            $event['project'] = $event->project;
            $endDate = $event->end_date;

        }

        $compare_function = function ($a, $b) {

            $a_timestamp = strtotime($a); // convert a (string) date/time to a (int) timestamp
            $b_timestamp = strtotime($b);

            // new feature in php 7
            return $a_timestamp <=> $b_timestamp;
        };
        usort($dates, $compare_function);



        foreach ($dates as $date) {

            $dateInfo = $date;
            //Convert the dateInfo string into a unix timestamp.
            $unixTimestamp = strtotime($dateInfo);
            //Get the day of the week using PHP's date function.
            $dayOfWeek = date("l", $unixTimestamp);
            $month = date('m', strtotime($date));
            $monthName =date('F', mktime(0, 0, 0, $month, 10));
            $day = date('j', strtotime($date));

            if($date == date('Y-m-d')){
                $tasks[$date]['today'] = 'si';
            }

            $ends = array('th','st','nd','rd','th','th','th','th','th','th');
            if (($day %100) >= 11 && ($day%100) <= 13)
            $abbreviation = $day. 'th';
            else
            $abbreviation = $day. $ends[$day % 10];



            $tasks[$date]['day'] = $monthName . ' ' . $abbreviation;
            $tasks[$date]['projects'] = [];
            $tasks[$date]['events'] = [];
        }

        foreach ($tasksDB as $taskDB) {
            $endDate = $taskDB->end_date;

            if (array_key_exists($endDate, $tasks)) {
                array_push($tasks[$endDate]['projects'], $taskDB);
            }
        }

        foreach ($events as $event) {
            $endDateEvent = $event->end_date;
            if (array_key_exists($endDateEvent, $tasks)) {
                array_push($tasks[$endDateEvent]['events'], $event);
            }
        }

        return $tasks;
    }


    public function getUsers()
    {
        $users = User::all();
        return $users;
    }


    public function getTemplates()
    {
        $templates = Templates::all();
        return $templates;
    }


    public function updateReminder($id){
        $reminder = Reminders::find($id);

        if($reminder->status == 1){
            $reminder->status = 0;
            $reminder->save();
            return $reminder->status;
        }else{
            $reminder->status = 1;
            $reminder->save();
            return $reminder->status;
        }
    }
    public function orderReminder($data){
        $reminders = json_decode($data, true);
        $i = 1;
        foreach($reminders as $reminder){
            $rem = Reminders::find($reminder['id']);
            $rem->order = $i;
            $rem->save();
            $i++;
        }
        return 'ok';
    }

    public function addReminder($formData)
    {

        $formData = json_decode($formData, true);

        $reminder = new Reminders;
        $reminder->message = $formData['message'];
        $reminder->user_id = Auth::id();
        $reminder->status = 1;
        $reminder->page = $formData['page'];
        $reminder->order = $formData['order'];
        $reminder->save();

        return ['id' => $reminder->id];
    }

    public function addTask($formData)
    {



        $formData = json_decode($formData, true);
        $data = explode(',', $formData['message']);

        foreach($formData['UsersTasks'] as $user){
            $task = new Tasks;

            $message = [];


            $i = 0;
            foreach ($data as $comment) {
                $i++;
                $temp = [
                    'id' => $i,
                    'data' => $comment,
                    'status' => 1
                ];
                array_push($message, $temp);
            }


            $task->message = json_encode($message);
            $task->status = $formData['status'];
            $task->end_date = $formData['end_date'];
            $task->user_id = $user;

            if (isset($formData['project']) && !empty($formData['project'])) {
                $task->project_id = $formData['project'];
            }

            if (isset($formData['client']) && !empty($formData['client'])) {
                $task->client_id = $formData['client'];
            }


            if (isset($formData['view']) && !empty($formData['view'])) {
                $task->view_id = $formData['view'];
            }

            $task->created_by = auth()->id();
            $task->save();
        }

        return ['status' => 'ok'];
    }


   public function deletePost($id){
        $post = Posts::find($id);
        $post->delete();
        return ['status' => 'ok'];
   }



    public function addPost(Request $request)
    {

        $post = new Posts;
        $post->title = $request['PostBtnTitle'];
        $post->message = $request['PostBtnMessage'];
        $post->user_id = Auth::id();
        $post->type = 'post';
        $post->client_id = $request['PostBtnClientSelect'];
        $post->project_id = $request['PostBtnProjectSelect'];

        if (isset($request['PostBtnViewSelect']) && !empty($request['PostBtnViewSelect']) && $request['PostBtnViewSelect'] != 'none') {
            $post->view_id = $request['PostBtnViewSelect'];
        }

        if (isset($request['PostBtnViewSelect']) && !empty($request['PostBtnViewSelect']) && $request['PostBtnViewSelect'] != 'none') {
            $post->view_id = $request['PostBtnViewSelect'];
        }

        if (isset($request['PostBtnFile']) && !empty($request['PostBtnFile'])) {
            $imagesArray = [];
            $iImages = 0;
            foreach($request['PostBtnFile'] as $file){
                $iImages++;
                $imageName = date("Y-m-d") . '-' . time() . '.' . $file->getClientOriginalExtension();
                $imagesArray[$iImages]['image'] = '/upload/posts/thumbnails/' . $imageName;
                $imagesArray[$iImages]['imageOriginal'] = '/upload/posts/' . $imageName;
                $img = $file->getRealPath();
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

                $resized->save('upload/posts/thumbnails/' . $imageName);
                $resized2->save('upload/posts/' . $imageName);
            }
            $post->images = json_encode($imagesArray);
        }
        $post->save();

        return 'se cargo el post';
    }

    function addPostTest($formData)
    {
        $formData = json_decode($formData, true);
        $post = new Posts;
        $post->title = $formData['title'];
        $post->message = $formData['message'];
        $post->user_id = Auth::id();
        $post->type = 'post';
        $post->client_id = $formData['client'];
        $post->project_id = $formData['project'];
        $post->save();
        return ['status' => 'ok'];
    }

    function addEvent($formData)
    {
        $formData = json_decode($formData, true);
        $event = new Events;
        $event->message = $formData['message'];
        $event->end_date = $formData['end_date'];

        if (isset($formData['client']) && !empty($formData['client'])) {
            $event->client_id = $formData['client'];
        }

        if (isset($formData['project']) && !empty($formData['project']) && $formData['project'] != 'All') {
            $event->project_id = $formData['project'];
        }

        if (isset($formData['view']) && !empty($formData['view']) && $formData['view'] != 'All') {
            $event->view_id = $formData['view'];
        }

        $event->save();

        return ['status' => 'ok'];
    }

    function addDelivery($formData)
    {
        $formData = json_decode($formData, true);
        $delivery = new Deliveries;

        if (isset($formData['message']) && !empty($formData['message'])) {
            $delivery->comment = $formData['message'];
        }

        $delivery->client_id = $formData['client'];
        $delivery->project_id = $formData['project'];

        if (isset($formData['view']) && !empty($formData['view'])) {
            $delivery->view_id = $formData['view'];
        }

        $delivery->template_id = $formData['template'];
        $delivery->save();

        return ['status' => 'ok'];
    }

}
