@extends('layouts.backend')
@section('title', 'Create Projects')
@section('other-css')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/formValidation.css') }}">
<!-- bootstrap select -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endsection

@section('content')
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Projects
        <small>Add</small>
      </h1>
        
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
      
      <div class="row">
        
        <div class="col-xs-12">
          
          <div class="box box-primary">
            
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form class="form-horizontal" id="frmData" method="post" action="{{ url('/couple') }}" autocomplete="off" enctype="multipart/form-data">
              
              {{ csrf_field() }}
              
              <div class="box-body">
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <select name="username" id="username" class="form-control selectpicker" title="-- Choose Username --">
                      @foreach($usernames as $u)
                        <option value="{{ $u->id }}" {{ $u->username == old('username') ? 'selected' : '' }} >{{ $u->username }}</option>
                      @endforeach
                    </select>
                  </div>
                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="nik" class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-10">
                      <textarea id="editor1" class="ckeditor" name="deskripsi"></textarea>  

                  </div>
                </div>
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Quotes</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="quotes" id="quotes" placeholder="put your quotes here" value="{{ old('quotes') }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamat" class="col-sm-2 control-label">Summary </label>
                  <div class="col-sm-10">
                   <textarea id="editor2" class="ckeditor" name="summary"></textarea> 
                  </div>
                </div>
                <div class="form-group">
                  <label for="phone" class="col-sm-2 control-label">Main Rundown *</label>
                  <div class="col-sm-10">
                     {!! Form::file('pdf', array('class' => 'image')) !!}
                  </div>
                </div>
                
                
              </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
                <div class="btn-group pull-right">
                  <a href="{{ url('/couple') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
                  <button type="submit" class="btn btn-primary" id="btnSubmit" style="margin-left: 5px;"><i class="fa fa-check"></i> Save</button>
                </div>
              </div>
              <!-- /.box-footer -->
            
            </form>
          
          </div>
          <!-- /.box -->
        </div>
        </div>
        <!-- /.col -->
      
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
<!-- page script -->
    <script type="text/javascript">
    $(document).ready(function(){
    karyawanModule.init();
    });
    </script>


@section('other-js')
    <script src="{{ asset('vendor/formvalidation/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/framework/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/autoNumeric/autoNumeric.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/fv-karyawan.js') }}"></script>

    <script type="text/javascript">  
      CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: "{{route('NewsController.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    </script>
    
    <script type="text/javascript">  
      CKEDITOR.replace('editor2', {
        filebrowserUploadUrl: "{{route('NewsController.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
      </script>  
@endsection
@endsection