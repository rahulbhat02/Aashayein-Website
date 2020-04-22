@extends('masterAdmin')
@section('content')

<div id="main">


    <div id="rec">

        <div id="LOGIN">
            <span>LOGIN</span>
        </div>
    </div>
    <div class="login">
        @if($errors->any())
        <div class="alert alert-danger">
            {{$errors->first('invalid')}}
            {{$errors->first('out')}}
        </div>
        @endif
        <form method="post" action="{{ url('/admin') }}">
            {{ csrf_field() }}
            <input type="text" placeholder="Username" id="username" name="username" required>
            <input type="password" placeholder="password" name="password" id="password" required>
            <div class="log_in_button">
                <button type="submit" class="btn btn-dark">Log In</button>
            </div>
        </form>


    </div>




    <div></div>


</div>

@endsection

@section('pagespecificscripts')
$("#nav_button").css("display", "none");
@stop