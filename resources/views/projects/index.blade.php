@extends('layouts.detail')
@section('content')
<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Projects</h2>
                    
                </div>
            </div>
            <div class="row">
                @foreach($projects as $project)
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="{{ url('/detail/'.$project->id) }}" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                       
                        <img src="{{ url($project->gbr1) }}" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4 style="color:black !important">{{ $project->pengantin_pria }} & {{ $project->pengantin_wanita }}</h4>
                        <p class="text-muted">{{ $project->quotes }}</p>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
@stop