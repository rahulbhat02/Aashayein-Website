@extends('master')
@section('title', ''. $site_info->website_name .' - About Us')

@section('pagespecificstyles')
<link rel="stylesheet" href="{{ asset('css/aboutStyle.css') }}">
<link rel="stylesheet" href="{{ asset('css/darkAboutStyle.css') }}">
@stop

@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-left">
                <div class="section-title mb-5">
                    <h2>About Us</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!--<div class="col-lg-6">
            <p>
              <img src="images/big_img_1.jpg" alt="Image" class="img-fluid">
            </p>
          </div>-->
            <div class="col-lg-12 pl-md-5">
                <p>{{ $about_us->about_us }}</p>
                <!--<p>Facilis sit molestiae deserunt quo corporis culpa dolorum animi architecto illum sapiente. Asperiores, placeat animi distinctio provident adipisci.</p>
            <ul class="ul-check list-unstyled success mt-5">
              <li>Lorem ipsum dolor sit.</li>
              <li>Cupiditate dolores rerum, consequatur!</li>
              <li>Quia dolor molestias voluptatem?</li>
            </ul>-->
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-left">
                <div class="section-title mb-5">
                    <h2>Our Mission</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!--<div class="col-lg-6">
            <p>
              <img src="images/big_img_1.jpg" alt="Image" class="img-fluid">
            </p>
          </div>-->
            <div class="col-lg-12 pl-md-5">
                <p>{{ $about_us->mission }}</p>
                <!--<p>Facilis sit molestiae deserunt quo corporis culpa dolorum animi architecto illum sapiente. Asperiores, placeat animi distinctio provident adipisci.</p>
            <ul class="ul-check list-unstyled success mt-5">
              <li>Lorem ipsum dolor sit.</li>
              <li>Cupiditate dolores rerum, consequatur!</li>
              <li>Quia dolor molestias voluptatem?</li>
            </ul>-->
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-left">
                <div class="section-title mb-5">
                    <h2>Our Vision</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!--<div class="col-lg-6">
            <p>
              <img src="images/big_img_1.jpg" alt="Image" class="img-fluid">
            </p>
          </div>-->
            <div class="col-lg-12 pl-md-5">
                <p>{{ $about_us->vision }}</p>
                <!--<p>Facilis sit molestiae deserunt quo corporis culpa dolorum animi architecto illum sapiente. Asperiores, placeat animi distinctio provident adipisci.</p>
            <ul class="ul-check list-unstyled success mt-5">
              <li>Lorem ipsum dolor sit.</li>
              <li>Cupiditate dolores rerum, consequatur!</li>
              <li>Quia dolor molestias voluptatem?</li>
            </ul>-->
            </div>
        </div>
    </div>
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
                            <a href="/blog/{{ $editors_pick[3] }}"><img src="img/{{ $editors_pick[2] }}" alt="Image"
                                    class="img-fluid"></a>

                            <div class="editors_pick_class">
                                <h2><a href="/blog/{{ $editors_pick[3] }}">{{ $editors_pick[0] }}</a></h2>
                                <div class="card__date">
                                    <span class="card__date__day">{{ $editors_pick[4] }}</span>
                                    <span class="card__date__month">{{ $editors_pick[5] }}</span>
                                </div>
                            </div>
                            <div class="editors_pick_line">
                                <hr />
                            </div>
                            <p>{{ $editors_pick[1] }}</p>
                            <div class="read_more">
                                <a href="/blog/{{ $editors_pick[3] }}" class="hvr-icon-forward">
                                    <p class="mb-3">
                                        Read more <i class="fa fa-angle-double-right hvr-icon" aria-hidden="true"></i>
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
                                    <span class="date-read">{{ $value->date }} {{ $value->month }}</span>
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
                            See All Trends <i class="fa fa-long-arrow-right hvr-icon" aria-hidden="true"></i>
                        </p>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>




<!-- END section -->
@endsection

@section('pagespecificscripts')


  var elements = document.getElementsByClassName('nav-link');
  var requiredElement = elements[1];
  requiredElement.classList.add('active');

  $(".nav-link.active").hover(
    function () {
      $(this).removeClass("hvr-underline-from-center");
    }
  );

@stop