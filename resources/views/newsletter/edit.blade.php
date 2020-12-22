@extends('layouts.backend')

@section('other-css')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/formValidation.css') }}">
@endsection

@section('content')
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        News Letter
        <small>Detail</small>
      </h1>
        
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/news-letter') }}"> News Letter</a></li>
        <li class="active">Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
      
      <div class="row">
        
        <div class="col-xs-12">
          
          <div class="box box-primary">
            
            <div class="box-header with-border">
              <h3 class="box-title">{{ $newsletter->title }}</h3>
            </div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form class="form-horizontal" id="frmData" method="post" action="{{ url('/news-letter') }}/{{ $newsletter->id }}" autocomplete="off" enctype="multipart/form-data">
              
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              
              <div class="box-body">
              
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Date</label>
                  <div class="col-sm-10">
                    <input type="text" class="date form-control" name="date" value="{{ date('d-m-Y', strtotime($newsletter->date)) }}">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') !== null ? old('title') : $newsletter->title }}" placeholder="Title">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Short Description</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="short_desc" id="short_desc" value="{{ old('short_desc') !== null ? old('short_desc') : $newsletter->short_desc }}" placeholder="short description">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Link Youtube</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="youtube" id="youtube" value="{{ old('youtube') !== null ? old('youtube') : $newsletter->youtube }}" placeholder="Link Youtube">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Stories</label>
                  <div class="col-sm-10">
                    <textarea id="editor1" class="ckeditor" name="stories" value="{{ old('Stories') !== null ? old('Stories') : $newsletter->stories }}">{{ $newsletter->stories }}</textarea>

                    <!-- <input type="text" class="form-control" name="email" id="email" value="{{ old('stories') !== null ? old('quotes') : $newsletter->stories }}" placeholder="Nama"> -->
                  </div>
                </div>


                <div class="form-group">
                  <label for="phone" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-10">

                   
                    <img src="{{asset('images/upload/newsletter/'.$newsletter->image) }}" width="505px" height="150px">
                    <input type="hidden" name="old_image" value="{{ $newsletter->image }}">
                    {!! Form::file('image', array('class' => 'image')) !!}
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
                <div class="pull-right">
                  <a href="{{ url('/news-letter') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
                  <button type="submit" class="btn btn-primary" id="btnSubmit"><i class="fa fa-save"></i> Save</button>
                </div>
                </div>
              <!-- /.box-footer -->
            
            </form>
          
          </div>
          <!-- /.box -->
        
        </div>
        <!-- /.col -->
      
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
    

@section('other-js')
<script type="text/javascript">
    $(document).ready(function(){
    coupleModule.init();
    });
    </script>

    <script type="text/javascript">  
    CKEDITOR.replace( 'editor1',{

        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
     });

    CKEDITOR.replace( 'editor2',{

        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
     });     

  </script>  
  <script type="text/javascript">

    $('.date').datepicker({  

       format: 'mm-dd-yyyy'

     });  

</script>  
@endsection
@endsection