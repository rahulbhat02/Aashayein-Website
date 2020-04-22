@extends('masterAdmin')

@section('pagespecificstyles')
<link rel="stylesheet" href="{{ asset('css/adminNewPost.css') }}">
@stop



@section('content')
<div id="main">

    <h3>Update Post</h3>

    <div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <form method="post" action="{{ url('/admin/update_post') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $post->id }}">
            <label for="heading">Post Title</label>
            <input type="text" id="heading" name="heading" value="{{ $post->heading }}" placeholder="Title for the post"
                required>

            <label for="img_view">Image for the Post</label><br />
            <img type="image" src="/img/{{ $post->image }}" name="post_img_view" id="img_view" required>
            <input style="display:none" type="file" id="img_add" name="img_view" class="form-control">
            <button onclick="change()" id="img_change" type="button"
                class="btn btn-outline-primary btn-sm">Change</button>
            <br>
            <br>
            <label for="caption">Caption</label>
            <input type="text" id="caption" name="caption" value="{{ $post->caption }}"
                placeholder="Caption for the post" required>

            <label for="intro">Introduction</label>
            <textarea id="intro" name="intro" placeholder="Write something.." style="height:100px"
                required>{{ $post->intro_text }}</textarea>

            <label for="body">Body</label>
            <textarea id="body" name="body" placeholder="Write something.." style="height:500px"
                required>{{ $post->body }}</textarea>




            <input type="submit" value="Submit">
        </form>
    </div>






</div>
@endsection


@section('pagespecificscripts')
function change(){
var a = document.getElementById("img_change");
if(a.innerHTML == "Change"){
document.getElementById("img_add").style.display = "block";
document.getElementById("img_view").style.display = "none";
a.innerHTML = "Cancel";
}
else{
document.getElementById("img_add").style.display = "none";
document.getElementById("img_view").style.display = "block";
document.getElementById("img_add").value = '';

a.innerHTML = "Change";
}



}
@stop