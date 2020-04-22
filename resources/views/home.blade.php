@extends('master')
@section('title', ''.  $site_info->website_name  .' - Home')


@section('pagespecificstyles')
  <link rel="stylesheet" href="{{ asset('css/homeStyle.css') }}">
  <link rel="stylesheet" href="{{ asset('css/darkHomeStyle.css') }}">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
@stop


@section('content')
          <div class="container">
            <div class="row wel">
              <div class="col-sm one">
                <div class="first_col">
                    <span class="Hey">Hi there<span class="comma">!</span></span>
                </div>
              </div>
              <div class="col-sm two">
                <div class="about">
                  <div id = "carousel1" class = "carousel slide car1" data-ride = "carousel">
                    <div class =" carousel-inner">
                      <div class = "carousel-item active car1_1">
                        <span class="abt">Who are we <span class="comma">?</span></span>
                        <hr class="line_below_abt"/>    
                        <span class="content_abt">{{ $info->who_are_we }}</span>
                      </div>
                      <div class = "carousel-item car1_2">
                        <span class="abt">Our Mission</span>
                        <hr class="line_below_abt"/>    
                        <span class="content_abt">{{ $info->mission }}</span>
                      </div>
                      <div class = "carousel-item car1_3">
                        <span class="abt">Our Vision</span>
                        <hr class="line_below_abt"/>    
                        <span class="content_abt">{{ $info->mission }}</span>
                      </div>
                    </div>
                     
                  </div>
                    <br/>
                    <button type="button" onclick="window.location.href = '/aboutUs';" class="btn learn_more">Learn more</button>
                </div>
              </div>
              
            </div>
          </div>
          <div class="follow">
              <span class="fl">Follow us on<a href="{{ $site_info->insta_link }}"  class="d-inline-block p-3 inst"><span  class="fa fa-instagram log" ></span></a></span>
          </div>
      <div id = "carousel" class = "carousel slide car2" data-ride = "carousel">
              <ol class = "carousel-indicators">
          @foreach($carousel as $value)
                  <li data-target="#carousel" data-slide-to="{{ $value->c }}" class="ind"></li>
          @endforeach
              </ol>

              <div class =" carousel-inner">
        @foreach($carousel as $value)
          <div class = "carousel-item pos">
              <div class="site-section" style="font-size: 10px;">
                <div class="container">
                  <div class="half-post-entry d-block d-lg-flex ">
                  
                    <div class="img-bg" style="background-image: url('img/{{ $value->image }}'); ">
                      <div class="card__date">
                        <span class="card__date__day">{{ $value->date }}</span>
                        <span class="card__date__month">{{ $value->month }}</span>
                      </div>
                  </div>
                    <div class="contents">
                      <span class="caption">Editor's Pick</span><br/><br/>
                      <h2><a href="/blog/{{ $value->post_id }}">{{ $value->heading }}</a></h2>
                      <hr/>
                      <p class="mb-3">{{ $value->intro_text }}</p>
                      <div class="read_more">
                        <a href="/blog/{{ $value->post_id }}" class="hvr-icon-forward">
                          <p class="mb-3">
                            Read more  <i class="fa fa-angle-double-right hvr-icon" aria-hidden="true"></i>
                          </p>
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
          </div>
        @endforeach



              </div>

              <a class = "carousel-control-prev" href = "#carousel" role = "button" data-slide = "prev">
                <span class = "carousel-control-prev-icon" aria-hidden = "true"></span>
                <span class = "sr-only">Previous</span>
              </a>

              <a class = "carousel-control-next" href = "#carousel" role = "button" data-slide = "next">
                <span class = "carousel-control-next-icon" aria-hidden = "true"></span>
                <span class = "sr-only">Next</span>
              </a>
      </div>

    <div class="site-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="row">
                <div class="col-12">
                  <div class="section-title">
                    <h2>Editor's Pick</h2>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">

                  <div class="post-entry-1">
                    <a href="/blog/{{ $editors_pick[3] }}"><img src="img/{{ $editors_pick[2] }}" alt="Image" class="img-fluid"></a>
        
                    <div class="editors_pick_class">
                      <h2><a href="/blog/{{ $editors_pick[3] }}">{{ $editors_pick[0] }}</a></h2>
                      <div class="card__date">
                        <span class="card__date__day">{{ $editors_pick[4] }}</span>
                        <span class="card__date__month">{{ $editors_pick[5] }}</span>
                      </div>
                    </div>
                    <div class="editors_pick_line">
                      <hr/>
                    </div>
                    <p>{{ $editors_pick[1] }}</p>
                    <div class="read_more">
                      <a href="/blog/{{ $editors_pick[3] }}" class="hvr-icon-forward">
                        <p class="mb-3">
                          Read more  <i class="fa fa-angle-double-right hvr-icon" aria-hidden="true"></i>
                        </p>
                      </a>
                    </div>
                  </div>

                </div>
                <div class="col-md-6">
          @foreach($pick as $value)
                  <div class="post-entry-2 d-flex">
                    <div class="thumbnail" style="background-image: url('img/{{ $value->image }}')"></div>
                    <div class="contents">
                      <h2><a href="/blog/{{ $value->post_id }}">{{ $value->heading }}</a></h2>
                      <div class="post-meta">
                        <div id="top_border"></div>
                        <span class="date-read">{{ $value->date }}  {{ $value->month }}</span>
                      </div>
                    </div>
                  </div>
          @endforeach
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="section-title">
                <h2>Trending</h2>
              </div>
        @foreach($trending as $value)
              <div class="trend-entry d-flex">
                <div class="number align-self-start">0{{ $value->c }}</div>
                <div class="trend-contents">
                  <h2><a href="/blog/{{ $value->post_id }}">{{ $value->heading }}</a></h2>
                
                </div>
              </div>
              
        @endforeach
                <div class="see_trends">
                  <a href="/blog" class="hvr-icon-forward">
                      <p class="mb-3">
                      See All Trends  <i class="fa fa-long-arrow-right hvr-icon" aria-hidden="true"></i>
                      </p>
                  </a>
                </div>

            </div>
          </div>
        </div>
      </div>
      <!-- END section -->
    <div class="container">
      <div class="section-title">
                    <h2>Top Posts</h2>
          </div>

    <div class="grid">
    @foreach($top_posts as $post)
      <article>
        <div class="top_post_date">
          <div class="card__date">
            <span class="card__date__day">{{ $post->date }}</span>
            <span class="card__date__month">{{ $post->month }}</span>
          </div>
        
          <img src="img/{{ $post->image }}" alt="Sample photo">
        </div>
        <div class="white_line">
        </div>
        <div class="text" id="text_edit">
          <h3>{{ $post->heading }}</h3>
          <hr/>
          <p class="cap">{{ $post->intro_text }}</p>
      <!--<a href="/blog/{{ $post->post_id }}" class="more" style="font-size:15px;">view <span class="icon-keyboard_arrow_right"></span></a>-->
          <div class="read_more top_p">
            <a href="/blog/{{ $post->post_id }}" class="hvr-icon-forward">
              <p class="mb-3">
                Read Full Article  <i class="fa fa-angle-double-right hvr-icon" aria-hidden="true"></i>
              </p>
            </a>
          </div>
        </div>
        <div class="top_post_line">
                      
                    </div>
      </article>

    @endforeach
    </div>
    <br>

    <div class="view_more_button_light">
      <a href="/blog" class="more"><button type="button" class="btn btn-light">View More</button></a>
    </div>
    <div class="view_more_button_dark">
      <a href="/blog" class="more"><button type="button" class="btn btn-dark">View More</button></a>
    </div>
    <br>
    </div>

    <div class="site-section">
      <div class="container">
      </div>
    </div>





@endsection

@section('pagespecificscripts')




  var elements = document.getElementsByClassName('pos');
  var requiredElement = elements[0];
  requiredElement.classList.add('active');

  var elements = document.getElementsByClassName('ind');
  var requiredElement = elements[0];
  requiredElement.classList.add('active');


  var elements = document.getElementsByClassName('nav-link');
  var requiredElement = elements[0];
  requiredElement.classList.add('active');

  $(".nav-link.active").hover(
  function () {
    $(this).removeClass("hvr-underline-from-center");
  }
  );



  $(document).ready(function() {
    setTimeout(function(){ 
   $('.first_col').addClass('fadeIn animated faster');
   }, 600);

   setTimeout(function(){ 
   $('.about').addClass('fadeIn animated ');
   }, 800);

   setTimeout(function(){ 
   $('.follow').addClass('fadeIn animated ');
   }, 1000);


    
   

  
    
  });

  

@stop
