@extends('layouts.client')
@section('content')
    @foreach ($package_takens as $pt)
    <h1>{{ $pt->name }}</h1>
    <p>{!! $pt->keterangan !!}</p>
    
    @endforeach

    @foreach ($packages_next as $pn)
    <!-- <h1>{{ $pn->nama }}</h1> -->

    <a href="{{ url('packages/').'/'.$pn->id }}"><div class="navbar-brand btn btn-sm pull-right" style="background-color:#d5c0b4"><p>GO TO NEXT PAGE</p></div>

    
    
    @endforeach

    @foreach ($packages_prev as $pv)
    <a href="{{ url('packages/').'/'.$pv->id }}"><div class="navbar-brand btn btn-sm pull-left" style="background-color:#d5c0b4"><p>GO TO PREVIOUS PAGE</p></div>

    @endforeach
@stop