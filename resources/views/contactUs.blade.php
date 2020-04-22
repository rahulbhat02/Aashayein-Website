@extends('master')
@section('title', ''. $site_info->website_name .' - Contact Us')

@section('pagespecificstyles')
<link rel="stylesheet" href="{{ asset('css/contactStyle.css') }}">
<link rel="stylesheet" href="{{ asset('css/darkContactStyle.css') }}">
@stop

@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if ($message = Session::get('success'))
                <div class="success_msg">
                    <i class="fa fa-check" aria-hidden="true"></i>

                    <div class="thank_you">Thank You!</div>
                    <div class="msg">Your message has been recieved.</div>
                </div>
                @endif

                @if ($message = Session::get('err'))
                <div class="success_msg">
                    <i class="fa fa-frown-o" aria-hidden="true"></i>

                    <div class="thank_you">Oops!</div>
                    <div class="msg">Something went wrong!.</div>
                </div>
                @endif
                @if(!Session::has('success') && !Session::has('err'))
                <div class="contact_us_form">
                    <div class="section-title mb-5">
                        <h2>Contact Us</h2>
                    </div>

                    <form method="post" onSubmit="formSubmit()" action="{{ url('/sendMail') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control form-control-lg"
                                    required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control form-control-lg"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="eaddress">Email Address</label>
                                <input type="email" name="eaddress" id="eaddress" class="form-control form-control-lg"
                                    required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="tel">Tel. Number</label>
                                <input type="text" name="tel" id="tel" class="form-control form-control-lg" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" cols="30" rows="10" class="form-control"
                                    required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                            </div>
                        </div>

                    </form>
                </div>
                @endif
            </div>

        </div>


    </div>
    <hr class="contact_us_line" style="width:50%" />
</div>




<!-- END section -->


@endsection

@section('pagespecificscripts')

var elements = document.getElementsByClassName('nav-link');
var requiredElement = elements[3];
requiredElement.classList.add('active');

$(".nav-link.active").hover(
function () {
$(this).removeClass("hvr-underline-from-center");
}
);

function formSubmit(){
$('.btn-primary').val('Sending...')
}

@stop