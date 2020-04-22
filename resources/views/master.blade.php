<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Compiled and Minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <!-- Compiled and Minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <link href="https://fonts.googleapis.com/css?family=B612+Mono|Cabin:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/darkStyle.css') }}">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!-- page specific styles -->
    @yield('pagespecificstyles')

</head>

<body>
    @include('loader')

    <div class="black_screen">
    </div>
    <div class="container" id="nav">
        <div class="row">
            <div class="col-lg-12">

                <nav class="navbar navbar-expand-sm  navbar-light">
                    <a href="/" class="navbar-brand hvr-bounce-in">
                        {{ $site_info->website_name }}
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <div class="display_advance">

                            <i class="fa fa-bars" style="font-size:20px;"></i>
                        </div>
                    </button>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="dark_mode">
                            <div class="moon">
                                <i class="fa fa-moon-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="light_mode">
                            <div class="sun">
                                <i class="fa fa-sun-o" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="insta-logo hvr-buzz-out">
                            <a href="{{ $site_info->insta_link }}" class="d-inline-block p-3 inst"><span
                                    style="font-size:30px" class="fa fa-instagram"></span></a>
                        </div>

                        <ul class="navbar-nav ">
                            <li class="nav-item ">
                                <a class="nav-link hvr-underline-from-center" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link hvr-underline-from-center" href="/aboutUs">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link hvr-underline-from-center" href="/blog">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link hvr-underline-from-center" href="/contactUs">Contact</a>
                            </li>



                        </ul>
                    </div>






                </nav>
            </div>


        </div>

        <hr class="nav_line">
    </div>

    <div class="wrapper" id="content">
        @yield('content')
        <!-- END section -->


        <footer>
            <div class="footer">
                <div class="container" id="foot">


                    <div class="row">
                        <div class="col-12">
                            <div class="navbar-brand">
                                {{ $site_info->website_name }}
                            </div>
                            <div class="footer__addr">
                                <h2>Contact</h2>

                                <address>
                                    {{ $site_info->address }}<br>

                                    <div class="contact_links">
                                        <a href="{{ $site_info->insta_link }}" class="d-inline-block p-3 inst"><span
                                                style="font-size:30px" class="fa fa-instagram "></span></a>
                                        <a href="/contactUs" class="d-inline-block p-3"><span style="font-size:30px"
                                                class="fa fa-envelope"></span></a>
                                    </div>
                                </address>
                            </div>
                            <div class="copyright">
                                <p>

                                    Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                    </script> {{ $site_info->website_name }}

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>






</body>
<script>
   if (document.readyState == 'loading') {
      // loading yet, wait for the event
      if (sessionStorage.getItem("mode") == 'dark') {
         $('.darkLoader').css('display', 'block');
         $('.lightLoader').css('display', 'none');
         on_dark_mode();
      } else {
         $('.darkLoader').css('display', 'none');
         $('.lightLoader').css('display', 'block');
      }
   }

   $(document).ready(function() {



      $('.loadingio-spinner-dual-ring-vr5oat4r6d').addClass('hidden');

      setTimeout(function() {
         $('.wrapper').addClass('hid');
      }, 250);

      setTimeout(function() {
         $('.navbar-collapse').addClass('fadeIn animated faster');
      }, 10);

      $("a").not(".carousel-control-prev, .carousel-control-next, .inst").click(function(event) {
         $('.wrapper').removeClass('hid');
         $('.loadingio-spinner-dual-ring-vr5oat4r6d').removeClass('hidden');
      });




      if ($(window).width() < 600) {
         $('.navbar-nav').removeClass('ml-auto');
      } else {
         $('.navbar-nav').addClass('ml-auto');
      }

   });

   $(".navbar-toggler").click(function() {
      $('#display_advance').toggle('1000');
      $("i", this).toggleClass("fa fa-bars fa fa-times");
      show_themes();
   });

   function show_themes() {
      $('.dark_mode').hide();
      $('.light_mode').hide();
      if (sessionStorage.getItem("mode") == 'dark') {
         setTimeout(function() {
               $('.light_mode').show();
         }, 400);
      } else {
         setTimeout(function() {
               $('.dark_mode').show();
         }, 400);
      }
   }

   $(".dark_mode").click(function() {
      sessionStorage.setItem("mode", "dark");

      $('.black_screen').css('background-color', 'black');
      $('.black_screen').addClass('show_black');

      setTimeout(function() {
         $('.dark_mode').css('display', 'none');
         $('.light_mode').css('display', 'block');
         $('body').css('background-color', 'black');
         $(".navbar").toggleClass('navbar-light navbar-dark');

         var x = document.getElementById("nav").querySelectorAll("div, hr");
         for (i = 0; i < x.length; i++) {
               $(x[i]).addClass('change_color');
         }

         var x = document.getElementById("content").querySelectorAll("div, hr, span");
         for (i = 0; i < x.length; i++) {
               $(x[i]).addClass('change_color');
         }

         $(".navbar-toggler").trigger("click");

      }, 1000);



      setTimeout(function() {
         $('.black_screen').removeClass('show_black');
      }, 1500);


      $('.lightLoader').css('display', 'none');
      $('.darkLoader').css('display', 'block');

   });

   $(".light_mode").click(function() {

      sessionStorage.removeItem("mode");

      $('.black_screen').css('background-color', 'white');
      $('.black_screen').addClass('show_black');

      setTimeout(function() {
         $('.dark_mode').css('display', 'block');
         $('.light_mode').css('display', 'none');
         $('body').css('background-color', 'white');
         $(".navbar").toggleClass('navbar-light navbar-dark');

         var x = document.getElementById("nav").querySelectorAll("div, hr");
         for (i = 0; i < x.length; i++) {
               $(x[i]).removeClass('change_color');
         }

         var x = document.getElementById("content").querySelectorAll("div, hr, span");
         for (i = 0; i < x.length; i++) {
               $(x[i]).removeClass('change_color');
         }

         $(".navbar-toggler").trigger("click");
      }, 1000);

      setTimeout(function() {
         $('.black_screen').removeClass('show_black');
      }, 1500);

      $('.darkLoader').css('display', 'none');
      $('.lightLoader').css('display', 'block');

   });

   function on_dark_mode() {
      $('body').css('background-color', 'black');
      $('.dark_mode').css('display', 'none');
      $('.light_mode').css('display', 'block')
      $(".navbar").toggleClass('navbar-light navbar-dark');

      var x = document.getElementById("nav").querySelectorAll("div, hr");
      for (i = 0; i < x.length; i++) {
         $(x[i]).addClass('change_color');
      }

      var x = document.getElementById("content").querySelectorAll("div, hr, span");
      for (i = 0; i < x.length; i++) {
         $(x[i]).addClass('change_color');
      }


   }



   window.addEventListener("pageshow", function(event) {
      var historyTraversal = event.persisted ||
         (typeof window.performance != "undefined" &&
               window.performance.navigation.type === 2);
      if (historyTraversal) {
         // Handle page restore.
         window.location.reload();
      }
   });


   @yield('pagespecificscripts')
</script>

</html>