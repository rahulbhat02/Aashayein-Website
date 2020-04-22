@extends('master')
@section('title', "$post_data->heading")

@section('pagespecificstyles')
  <link rel="stylesheet" href="{{ asset('css/postStyle.css') }}">
  <link rel="stylesheet" href="{{ asset('css/darkPostStyle.css') }}">
@stop

@section('content')
  <div class="site-section">
      <div class="container">
        <div class="row">
          
          <div class="col-lg-8 single-content">
            
            <p class="mb-5">
              <img src="{{ asset('img/'.$post_data->image) }}" alt="Image" class="img-fluid">
            </p>
            
            <div class="card__date">
                        <span class="card__date__day">{{ $post_data->date }}</span>
                        <span class="card__date__month">{{ $post_data->month }}</span>
            </div>
            <h1 class="mb-4">
			{{ $post_data->heading }}
            </h1>
            <hr/>
            <div class="caption_of_post">
              <span class="black_comma">'</span> {{ $post_data->caption }} <span class="black_comma">'</span> 
            </div>  
            <br/>
            <br/>
            <div class="body_of_post">
            {!! nl2br(e($post_data->body)) !!}
            
            </div>

            <hr style="text-align:center; width:50%;"/>
            
      
      
               
          </div>
		  

          <div class="col-lg-3 ml-auto">
            <div class="section-title">
              <h2>Popular Posts</h2>
            </div>

            
            @foreach($trending as $value)
            <div class="trend-entry d-flex">
              <div class="number align-self-start">0{{ $value->c }}</div>
              <div class="trend-contents">
                <h2><a href="/blog/{{ $value->post_id }}">{{ $value->heading }}</a></h2>
                <div class="post-meta">
                <div id="top_border"></div>
                        <span class="date-read">{{ $value->date }}  {{ $value->month }}</span>
                      </div>
              </div>
            </div>
			@endforeach
			
            

           

            
            
                <div class="see_trends">
                  <a href="/blog" class="hvr-icon-forward">
                      <p class="mb-3">
                      See All Trends   <i class="fa fa-long-arrow-right hvr-icon" aria-hidden="true"></i>
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


@stop