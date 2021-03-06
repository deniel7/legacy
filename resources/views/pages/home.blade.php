@extends('layouts.default')
@section('content')
        <!-- Portfolio Grid Section -->
    <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="hl"></div>
                    <h2 class="section-heading">The Special Days</h2>
                    <h3 class="section-subheading text-muted">What greater thing is there for two human souls, than to feel that they are joined for life — to strength each other in all labor, to rest on each other in all sorrow, to minister to each other in all pain, to be with each other in silent unspeakable memories at the moment of the last parting? —George Eliot</h3>
                    <h3>
                        
                      </h3>
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
            <div class="row">
            <div class="col-lg-12 text-center">
                <?php //$instagram = json_decode($instagrams); ?>
                <div class="hl"></div>
                    <h4 class="section-subheading">Instagram Feed</h4>
            </div>
                @for($i=0; $i <= 2; $i++)
                    


                    <div class="col-md-4 col-sm-6 portfolio-item">
                        
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                       
                        
                        {{-- <img class="img-responsive" src="{{ $instagram[$i]->images->standard_resolution->url }}" /> --}}
                    </div>

                @endfor

                

            </div>
        </div>
    </section>
@stop
