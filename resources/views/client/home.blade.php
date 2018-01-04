@extends('layouts.client')
@section('content')
<!-- Portfolio Grid Section -->
<div class="row">
    <div class="col-xs-8">
        <h4>Events</h4>
        @foreach ($events as $event)
        
        <ul class="event-list">
            
            <li>
                <time datetime="2014-07-31 1600">
                <span class="day"><?php echo date('d', strtotime($event->tanggal)); ?></span>
                <span class="month"><?php echo date('M', strtotime($event->tanggal)); ?></span>
                
                
                </time>
                
                <div class="info">
                    <h2 class="title"><?php echo date('Y', strtotime($event->tanggal)); ?></h2>
                    <p class="desc"> {{ $event->event}}</p>
                    <ul>
                        <li style="width:33%;">Last Update :<span class="fa fa-male"></span></li>
                        <li style="width:34%;"><?php echo date('d M Y H:i:s', strtotime($event->updated_at)); ?><span class="fa fa-child"></span></li>
                    </ul>
                </div>
            </li>
        </ul>
        @endforeach
            <div class="row">
            <h4>Main Rundown</h4>
            <a href="{{ url('user-logout') }}"><button type="button" class="navbar-brand btn btn-danger btn-sm pull-right"><p>Download PDF</p></button></a>
            </div>

            <hr>
            <div class="row">
            <h4>Summary Budget</h4>
            @foreach ($projects as $project)
            <p>{!! $project->summary !!}</p>
            @endforeach
            </div>

            <hr>
            <div class="row">
            <h4>Couple Data</h4>
            <a href="{{ url('user-logout') }}"><button type="button" class="navbar-brand btn btn-default btn-sm pull-right"><p>View</p></button>
            </div>

    </div>
    

    
</div>


@stop