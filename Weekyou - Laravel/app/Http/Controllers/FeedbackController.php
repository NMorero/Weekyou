<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Deliveries;
use App\Developers;
use App\Events;
use App\Feedbacks;
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
use App\Tasks;
use App\Templates;
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


class FeedbackController extends Controller
{
    public function create()
    {
        $clients = [];
        $id = Auth::user()->id;

        if (auth()->user()->roles->rol == 'developer'){
            $dev = Developers::where('user_id', 'LIKE', $id)->get();
            $devProjects = ProjectDevelopers::where('developer_id','LIKE',$dev[0]->id)->get();

            foreach($devProjects as $devProject){
                $project = Projects::find($devProject->id);
                $client = Clients::find($project->client_id);
                $clients[] = $client;
            }
        }else if(auth()->user()->roles->rol == 'PRleader'){
            $lead = ProjectLeaders::where('user_id', 'LIKE', $id)->get();
            $leadProjects = Projects::where('leader_id', 'LIKE', $lead[0]->id)->get();
            foreach($leadProjects as $leadProject){
                $project = Projects::find($leadProject->id);
                $client = Clients::find($project->client_id);
                $clients[] = $client;
            }
        }else if(auth()->user()->roles->rol == 'PRmanager'){
            $man = ProjectManagers::where('user_id', 'LIKE', $id)->get();
            $manProjects = Projects::where('manager_id', 'LIKE', $man[0]->id)->get();
            foreach($manProjects as $manProject){
                $project = Projects::find($manProject->id);
                $client = Clients::find($project->client_id);
                $clients[] = $client;
            }
        }else if(auth()->user()->roles->rol == 'admin'){
            $clients = Clients::all();
        }
        $vac = compact('clients');
        return view('createFeedback', $vac);
    }

    public function addFeedback(Request $request)
    {
        $b64 = $request['imgCanvas'];

        define('UPLOAD_DIR', 'upload/feedbacks/');
        $img = $b64;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);



            $imageName = date("Y-m-d") . '-' . time() . '.' . 'jpg';
            $file ='upload/feedbacks/thumbnails/' . $imageName;
            $file2 ='upload/feedbacks/' . $imageName;
            $resized = Image::make($data);
            $width = $resized->width();
            $height = $resized->height();

            $resized2 = Image::make($data);

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

            $resized->save('upload/feedbacks/thumbnails/' . $imageName, 100);
            $resized2->save('upload/feedbacks/' . $imageName, 100);



        $feedback = new Feedbacks;
        $comentaries = [];
        $i = 0;
        foreach ($request['comments'] as $comment) {
            $i++;
            $commentary = [
                'comment' => $comment['value'],
                'status' => 'undone',
                'id' => $i,
                'image' => $comment['image']
            ];
            array_push($comentaries, $commentary);
        }


        $feedback->message = json_encode($comentaries);
        $feedback->client_id = $request['client'];
        $feedback->project_id = $request['project'];
        if (isset($request['view']) && $request['view'] != 'none') {
            $feedback->view_id = $request['view'];
        }

        $feedback->image = $file;
        $feedback->image_original = $file2;
        $feedback->save();
        $post = new Posts();

        $post->title = 'New Feedback';
        $post->message = ' ';
        $post->image = $file;
        $post->image_original = $file2;
        $post->user_id = Auth::id();
        $post->client_id = $request['client'];
        $post->project_id = $request['project'];
        if (isset($request['view']) && $request['view'] != 'none') {
            $post->view_id = $request['view'];
        }
        $post->feedback_id = $feedback->id;
        $post->type = "feedbackCreate";
        $post->save();


        return ['status' => 'ok'];
    }



    public function deleteFeedback($id){
        $posts = Posts::where('feedback_id', 'LIKE', $id)->get();
        foreach($posts as $post){
            $post->delete();
        }
        $feedback = Feedbacks::find($id);
        $feedback->delete();
        return ['status' => 'ok'];
    }

    public function edit($id)
    {
        $feedback = Feedbacks::find($id);
        $feedback['comments'] = json_decode($feedback->message, true);
        $id = $id;


        $vac = compact('feedback', 'id');
        return view('feedbackEdit', $vac);
    }

    public function saveFeedbackChange(Request $request)
    {
        $feedback = Feedbacks::find($request['id']);
        $feedback->message = $request['comments'];
        $feedback->save();


        $post = new Posts();

        $post->title = 'Feedback edited';
        $post->message = ' ';
        $post->image = $feedback->image;
        $post->user_id = Auth::id();
        $post->client_id = $feedback->client_id;
        $post->project_id = $feedback->project_id;
        $post->type = 'feedback';
        if (isset($feedback->view_id) && $feedback->view_id != 'none') {
            $post->view_id = $feedback->view_id;
        }
        $post->feedback_id = $request['id'];
        $post->save();





        return ['status' => 'Listo'];
    }

    public function getClients(){
        $clients = [];
        $id = Auth::user()->id;

        if (auth()->user()->roles->rol == 'developer'){
            $dev = Developers::where('user_id', 'LIKE', $id)->get();
            $devProjects = ProjectDevelopers::where('developer_id','LIKE',$dev[0]->id)->get();

            foreach($devProjects as $devProject){
                $project = Projects::find($devProject->project_id);
                $client = Clients::find($project->client_id);
                $clients[] = $client;
            }
        }else if(auth()->user()->roles->rol == 'PRleader'){
            $lead = ProjectLeaders::where('user_id', 'LIKE', $id)->get();

            $leadProjects = Projects::where('leader_id', 'LIKE', $lead[0]->id)->get();
            foreach($leadProjects as $leadProject){
                $project = Projects::find($leadProject->id);
                $client = Clients::find($project->client_id);
                $clients[] = $client;
            }
        }else if(auth()->user()->roles->rol == 'PRmanager'){
            $man = ProjectManagers::where('user_id', 'LIKE', $id)->get();
            $manProjects = Projects::where('manager_id', 'LIKE', $man[0]->id)->get();
            foreach($manProjects as $manProject){
                $project = Projects::find($manProject->id);
                $client = Clients::find($project->client_id);
                $clients[] = $client;
            }
        }else if(auth()->user()->roles->rol == 'admin'){
            $clients = Clients::all();
        }

        return $clients;

    }

    public function getProjects($client)
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
}
