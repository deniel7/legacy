@extends('layouts.backend')
@section('title', 'Banner')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Banner
  <small>upload</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li><a href="#">Master</a></li>
    <li><a href="{{ url('/vendor') }}">Banner</a></li>
    <li class="active">List</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">



    <div class="container">


@if (count($errors) > 0)

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


@if ($message = Session::get('success'))

<div class="alert alert-success alert-block">

    <button type="button" class="close" data-dismiss="alert">×</button> 

    <strong>{{ $message }}</strong>

</div>

@endif


{!! Form::open(array('url' => 'banners','enctype' => 'multipart/form-data')) !!}
    <div class="row">
    
        <!-- <div class="col-md-4">

            <br/>

            {!! Form::text('title', null,array('class' => 'form-control','placeholder'=>'Add Title')) !!}

        </div> -->
        <div class="row">
        <div class="col-md-12">
        <label>Please upload image for this Main Picture on resolution : 1280 x 600 pixels with Landscape Orientation</label>
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-12">
        @foreach($banners as $item)
            <img src="{{asset('images/upload/banner/'.$item->image1) }}" width="505px" height="150px">
            <input type="hidden" name="img1" value="{{ $item->image1 }}">
            {!! Form::file('image1', array('class' => 'image')) !!}

        </div>
        </div>

        
        
        <div class="row">
        <div class="col-md-12">
        <br/>
            <img src="{{asset('images/upload/banner/'.$item->image2) }}" width="800px" height="350px">
            <input type="hidden" name="img2" value="{{ $item->image2 }}">
            {!! Form::file('image2', array('class' => 'image')) !!}

        </div>
        </div>

        <div class="row">
        <div class="col-md-12">

            <br/>
            <img src="{{asset('images/upload/banner/'.$item->image3) }}" width="800px" height="350px">
            <input type="hidden" name="img3" value="{{ $item->image3 }}">
            {!! Form::file('image3', array('class' => 'image')) !!}

        </div>
        </div>

        <div class="row">
        <div class="col-md-12">

            <br/>
            <img src="{{asset('images/upload/banner/'.$item->image4) }}" width="800px" height="350px">
            <input type="hidden" name="img4" value="{{ $item->image4 }}">
            {!! Form::file('image4', array('class' => 'image')) !!}

        </div>
        </div>

        <div class="row">
        <div class="col-md-12">
            <br/>
            <img src="{{asset('images/upload/banner/'.$item->image5) }}" width="800px" height="350px">
            <input type="hidden" name="img5" value="{{ $item->image5 }}">
            {!! Form::file('image5', array('class' => 'image')) !!}

        </div>
        </div>
  
@endforeach

        <div class="col-md-12">

            <br/>

            <button type="submit" class="btn btn-success">Upload</button>

        </div>

        
    </div>

{!! Form::close() !!}

</div>
    

        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  
</section>
<!-- /.content -->


<!-- page script -->
<style>
.datepicker{z-index:1151 !important;}
</style>
<script type="text/javascript">
$(document).ready(function(){
vendorModule.init();
});
</script>
@endsection