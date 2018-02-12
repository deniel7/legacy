@extends('layouts.client')
@section('content')
<!-- Portfolio Grid Section -->
<div class="row">
    <div class="col-xs-8">
        <div class="row">
        <h4>Welcome {{ Auth::user()->get()->username }}</h4>
        <hr/>
        <h3 class="section-subheading">Your Wedding Schedule</h3>
        @foreach ($events as $event)
        <div class="col-xs-8">
        <ul class="event-list">
            
            <li>
                <time datetime="2014-07-31 1600">
                <span class="day" style="word-wrap: break-word"><?php echo date('d', strtotime($event->tanggal)); ?></span>
                <span class="month" style="word-wrap: break-word"><?php echo date('M', strtotime($event->tanggal)); ?></span>
                
                
                </time>
                
                <div class="info">

                    <p class="desc" style="word-wrap: break-word"> {{ $event->event}}</p>
                    
                </div>
            </li>
        </ul>
        </div>
        @endforeach
        </div>
            <div class="row">
            <h3>Wedding Budget</h3>
            @foreach ($projects as $project)
            <p>{!! $project->summary !!}</p>
            @endforeach
            </div>

            <hr>
            <div class="row">
            <h3>Wedding Data</h3>
            <a href="{{ url('wedding-data') }}"><button type="button" class="navbar-brand btn btn-default btn-sm pull-right"><p>View</p></button>
            </div>

             <hr>

            <div class="row">
            <h3>Wedding Summary & Rundown</h3>
            <!-- {{ $dl['main_rundown'] }}
            $destinationPath = public_path('/images/upload/pdf'); -->
            <a target="_blank" href="{{ url('/images/upload/pdf/') }}/{{ $dl['main_rundown'] }}"><button type="button" class="navbar-brand btn btn-danger btn-sm pull-right"><p>Download PDF</p></button></a>
             
            </div>

           
            

            

    </div>
    

    
</div>


@stop