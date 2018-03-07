@extends('layouts.detail')
@section('content')
<!-- Portfolio Grid Section -->
<section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Legacy Projects</h2>
                    
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
                       
                        <img src="{{ url('images/upload/thumbnail/'.$project->gbr1) }}" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <p style="color:#d5c0b4 !important">{{ strtoupper($project->pengantin_pria) }} & {{ strtoupper($project->pengantin_wanita) }}</p>
                        <!-- <p class="text-muted">{{ $project->quotes }}</p> -->
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
@stop