@extends('layouts.client')
@section('content')

    @foreach ($package_takens as $pt)
    <h1>{{ $pt->name }}</h1>
    <p>{{ $pt->keterangan }}</p>
    
    @endforeach

@stop