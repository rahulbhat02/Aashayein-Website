@extends('master')
@section('title', ''. $site_info->website_name .' - Blog')

@section('pagespecificstyles')
<link rel="stylesheet" href="{{ asset('css/categoriesStyle.css') }}">
<link rel="stylesheet" href="{{ asset('css/darkCategoriesStyle.css') }}">
@stop

@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="section-title">
                    <span class="caption d-block small">Top</span>
                    <h2>Posts</h2>
                </div>
                <div class="grid">
                    @foreach($posts as $post)
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
                            <hr />
                            <p>{{ $post->intro_text }}</p>
                            <!--<a href="/blog/{{ $post->post_id }}" class="more" style="font-size:15px;">view <span class="icon-keyboard_arrow_right"></span></a>-->
                            <div class="read_more top_p">
                                <a href="/blog/{{ $post->post_id }}" class="hvr-icon-forward">
                                    <p class="mb-3">
                                        Read Full Article <i class="fa fa-angle-double-right hvr-icon"
                                            aria-hidden="true"></i>
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="top_post_line">

                        </div>
                    </article>

                    @endforeach
                </div>







                <br />

                <hr class="end_line" />
            </div>
            <div class="col-lg-3">
                <div class="section-title">
                    <h2>Popular Posts</h2>
                </div>
                @foreach($trending as $value)
                <div class="trend-entry d-flex">
                    <div class="number align-self-start">0{{ $value->c }}</div>
                    <div class="trend-contents">
                        <h2><a href="/blog/{{ $value->post_id }}">{{ $value->heading }}</a></h2>
                        <div id="top_border"></div>
                        <span class="date-read">{{ $value->date }} {{ $value->month }}</span>
                    </div>
                </div>

                @endforeach


                <div class="see_trends">
                    <a href="/blog" class="hvr-icon-forward">
                        <p class="mb-3">
                            See All Popular <i class="fa fa-long-arrow-right hvr-icon" aria-hidden="true"></i>
                        </p>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <ul class="custom-pagination list-unstyled">
                    {{ $posts->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>




<!-- END section -->

@endsection

@section('pagespecificscripts')
var elements = document.getElementsByClassName('nav-link');
var requiredElement = elements[2];
requiredElement.classList.add('active');

$(".nav-link.active").hover(
function () {
$(this).removeClass("hvr-underline-from-center");
}
);

@stop