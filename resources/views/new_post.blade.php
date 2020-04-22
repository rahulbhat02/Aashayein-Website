@extends('masterAdmin')

@section('pagespecificstyles')
<link rel="stylesheet" href="{{ asset('css/adminNewPost.css') }}">
@stop

@section('content')

<div id="main">



    <h3>New Post</h3>

    <div class="container">
        <form method="post" action="{{ url('/admin/add_post') }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="heading">Post Title</label>
            <input type="text" id="heading" name="heading" placeholder="Title for the post" required>

            <label for="img">Image</label>
            <input type="file" name="image" class="form-control" required>

            <br>
            <label for="caption">Caption</label>
            <input type="text" id="caption" name="caption" placeholder="Caption for the post" required>

            <label for="intro">Introduction</label>
            <textarea id="intro" name="intro" placeholder="Write something.." style="height:100px" required></textarea>

            <label for="body">Body</label>
            <textarea id="body" name="body" placeholder="Write something.." style="height:500px" required></textarea>




            <input type="submit" value="Submit">
        </form>
    </div>






</div>

@endsection