@extends('layouts.base')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
    <main class="container-fluid row d-flex py-2 justify-content-between pr-1">
        <div class="col-9" style="height:85vh">
            <img src="/{{$feedback->image_original}}" alt="" height="100%" width="100%">
        </div>

        <div class="col-3 ">



            <form action="/Actions" id="editFeedback" name="editFeedback" method="post">
                <input type="number" name="" id="id" value="{{$id}}" hidden>
                <input type="text" name="" id="comments" value="{{json_encode($feedback->comments)}}" hidden>
                @foreach ($feedback->comments as $comment)
                <div class="custom-control custom-checkbox my-1 border-bottom p-2">
                    <input type="checkbox" class="custom-control-input checkboxes" id="comment{{$comment['id']}}" @if ($comment['status'] == 'done')
                    checked
                @endif>
                    <label class="custom-control-label" for="comment{{$comment['id']}}" >{{$comment['comment']}}</label>
                </div>
                @endforeach
                <button type="submit" class="btn btn-info mt-3 " id="submitFeedback">Save</button>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{asset('js/feedbacks.js')}}"></script>
@endsection
