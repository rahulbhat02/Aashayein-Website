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
    <form method="post" action="{{ url('/admin/updateSiteSettings') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label for="website_name">Website Name</label>
        <textarea id="website_name" name="website_name" placeholder="Name of the website..." style="height:100px"
            required>{{ $data->website_name }}</textarea>

        <br>

        <label for="website_email">Website Email</label>
        <textarea id="website_email" name="website_email" placeholder="Email of the website..." style="height:100px"
            required>{{ $data->website_email }}</textarea>

        <br>

        <label for="insta_link">Instagram Link</label>
        <textarea id="insta_link" name="insta_link" placeholder="Link of the instagram page..." style="height:100px"
            required>{{ $data->insta_link }}</textarea>

        <br>

        <label for="address">Address</label>
        <textarea id="address" name="address" placeholder="Address of the team..." style="height:100px"
            required>{{ $data->address }}</textarea>

        <br>

        <input type="submit" value="Submit">
    </form>
</div>






</div>

@endsection

@section('pagespecificscripts')

@stop