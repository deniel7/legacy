@extends('layouts.backend')

@section('other-css')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/formValidation.css') }}">
@endsection

@section('content')
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Project
        <small>Edit</small>
      </h1>
        
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/couple') }}"> Couple</a></li>
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
              <h3 class="box-title">Data Project</h3>
            </div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form class="form-horizontal" id="frmData" method="post" action="{{ url('/couple') }}/{{ $projects->id }}" autocomplete="off">
              
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              
              <div class="box-body">
              

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Quotes</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="quotes" id="quotes" value="{{ old('quotes') !== null ? old('quotes') : $projects->quotes }}" placeholder="Quotes">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-10">
                    <textarea id="editor1" class="ckeditor" name="deskripsi" value="{{ old('deskripsi') !== null ? old('deskripsi') : $projects->deskripsi }}">{{ $projects->deskripsi }}</textarea>

                    <!-- <input type="text" class="form-control" name="email" id="email" value="{{ old('deskripsi') !== null ? old('quotes') : $projects->deskripsi }}" placeholder="Nama"> -->
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Summary Budget</label>
                  <div class="col-sm-10">
                  <textarea id="editor2" class="ckeditor" name="summary" value="{{ old('summary') !== null ? old('summary') : $projects->summary }}">{{ $projects->summary }}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="phone" class="col-sm-2 control-label">Main Rundown *</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="old_pdf" value="{{ $projects->main_rundown }}" />
                     {!! Form::file('pdf', array('class' => 'image')) !!}
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
                <div class="pull-right">
                  <a href="{{ url('/couple') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
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
@endsection
@endsection