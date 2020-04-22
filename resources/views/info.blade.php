@extends('masterAdmin')

@section('pagespecificstyles')
<link rel="stylesheet" href="{{ asset('css/adminNewPost.css') }}">
@stop

@section('content')
<h3>Edit Info</h3>

<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <form method="post" action="{{ url('/admin/updateInfo') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="abt">About Us</label>
        <textarea id="abt" name="abt" placeholder="Write something.." style="height:100px"
            required>{{ $data->about_us }}</textarea>

        <br>

        <label for="who_are_we">Who are we ?</label>
        <textarea id="who_are_we" name="who_are_we" placeholder="Write something.." style="height:100px"
            required>{{ $data->who_are_we }}</textarea>

        <br>

        <label for="mission">Mission</label>
        <textarea id="mission" name="mission" placeholder="Write something.." style="height:100px"
            required>{{ $data->mission }}</textarea>

        <br>

        <label for="vision">Vision</label>
        <textarea id="vision" name="vision" placeholder="Write something.." style="height:100px"
            required>{{ $data->vision }}</textarea>

        <br>

        <input type="submit" value="Submit">
    </form>
</div>






</div>

@endsection

@section('pagespecificscripts')

@stop