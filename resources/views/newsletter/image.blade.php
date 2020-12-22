@extends('layouts.backend')



@section('content')
    
    <div class="container">

<h1>Upload Image </h1>

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

<div class="row">

    <!-- <div class="col-md-4">

        <strong>Original Image:</strong>

        <br/>

        <img src="/images/upload/{{ Session::get('imageName') }}" />

    </div>

    <div class="col-md-4">

        <strong>Thumbnail Image:</strong>

        <br/>

        <img src="upload/thumbnail/{{ Session::get('imageName') }}" />

    </div> -->

</div>

@endif


{!! Form::open(array('route' => 'resizeImagePost','enctype' => 'multipart/form-data')) !!}

    <div class="row">
    @foreach($id as $i)
    <input type="hidden" name="id" value={{ $i->id }}>
    @endforeach
        <!-- <div class="col-md-4">

            <br/>

            {!! Form::text('title', null,array('class' => 'form-control','placeholder'=>'Add Title')) !!}

        </div> -->

        <div class="col-md-12">
        <label>MAIN PICTURE</label><br/>
        <label>Please upload image for this Main Picture on resolution : 1280 x 600 pixels with Landscape Orientation</label>

            {!! Form::file('image1', array('class' => 'image')) !!}

        </div>

        <br/><br/><br/><br/><br/>

        <div class="col-md-6">
        <br/>
            {!! Form::file('image2', array('class' => 'image')) !!}

        </div>

        <div class="col-md-6">

            <br/>

            {!! Form::file('image3', array('class' => 'image')) !!}

        </div>

        <div class="col-md-6">

            <br/>

            {!! Form::file('image4', array('class' => 'image')) !!}

        </div>

        <div class="col-md-6">

            <br/>

            {!! Form::file('image5', array('class' => 'image')) !!}

        </div>

        <div class="col-md-6">

            <br/>

            {!! Form::file('image6', array('class' => 'image')) !!}

        </div>

        <div class="col-md-6">

            <br/>

            {!! Form::file('image7', array('class' => 'image')) !!}

        </div>

        <div class="col-md-6">

            <br/>

            {!! Form::file('image8', array('class' => 'image')) !!}

        </div>

        <div class="col-md-6">

            <br/>

            {!! Form::file('image9', array('class' => 'image')) !!}

        </div>

       

        <div class="col-md-12">

            <br/>

            <button type="submit" class="btn btn-success">Upload Image</button>

        </div>

    </div>

{!! Form::close() !!}

</div>
    
@endsection
