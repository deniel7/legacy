@extends('layouts.newsletter')
@section('content')
<!-- Portfolio Grid Section -->
<section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    
                        <div class="hl"></div>
                            <h2 class="section-heading"></h2>
                            <h3 class="section-subheading text-muted">Hello, thank you for reaching out for us !</h3>
                    
					<!-- Post -->
					@foreach($newsletters as $newsletter)
							<article class="post">
								<header>
									<div class="title">
										<h2 class="section-heading">{{ $newsletter->title }}</h2>
										<p>{{ $newsletter->short_desc }}</p>
									</div>
									<div class="meta">
										<time class="published" datetime="2015-11-01">{{ $newsletter->date }}</time>
										<a href="#" class="author"><img src="{{ url('images/upload/avatar.jpg') }}"</a>
									</div>
								</header>
								<a href="{{ url('/detail-newsletter/'.$newsletter->id) }}" class="image featured"><img src="{{ url('images/upload/'.$newsletter->image) }}" class="img-responsive" alt=""></a>
								{{-- <p>{{ $newsletter->short_desc }}</p> --}}
								<footer>
									<ul class="actions">
										<li><a href="{{ url('/detail-newsletter/'.$newsletter->id) }}" class="button large">Read More....</a></li>
									</ul>
									
								</footer>
							</article>
					@endforeach
                </div>
            </div>
            <br/>
            
        </div>
    </section>
@stop