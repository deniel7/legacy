@extends('layouts.newsletter')
@section('content')
<!-- Portfolio Grid Section -->
<section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					 
					<!-- Post -->
				@foreach($newsletters as $newsletter)
					<article class="post">
						<header>
							<div class="title">
								<h2><a href="{{ url('/detail-newsletter/'.$newsletter->id) }}">{{ $newsletter->title }}</a></h2>
								<p>{{ $newsletter->short_desc }}</p>
							</div>
							<div class="meta">
								<time class="published" datetime="2015-11-01">{{ $newsletter->date }}</time>
								<a href="#" class="author"><span class="name">Jane Doe</span><img src="{{ url('images/upload/avatar.jpg') }}"></a>
							</div>
						</header>
						<a href="{{ url('/detail-newsletter/'.$newsletter->id) }}" class="image featured"><img src="{{ url('images/upload/'.$newsletter->image) }}" class="img-responsive" alt=""></a>
						   
						<p>{!! $newsletter->stories !!}</p>

						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $newsletter->youtube }}" frameborder="0" allowfullscreen></iframe>
						</div> 
					</article>
				@endforeach
                            
                </div>
            </div>
            <br/>
            
        </div>
    </section>
@stop