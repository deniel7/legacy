@extends('layouts.backend')
@section('title', 'Add Event')
@section('other-css')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/formValidation.css') }}">
<!-- bootstrap select -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endsection

@section('content')
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Event
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
            
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Data Karyawan</h3>
            </div> -->
            <!-- /.box-header -->
            
            <!-- form start -->
            <form class="form-horizontal" id="frmData" method="post" action="{{ url('/events') }}" autocomplete="off">
              {{ csrf_field() }}
              
              <div class="box-body">
                
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="text" class="date form-control" name="tanggal">
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <select name="username" id="username" class="form-control selectpicker" title="-- Choose Username --">
                      @foreach($usernames as $u)
                        <option value="{{ $u->id }}" {{ $u->username == old('username') ? 'selected' : '' }} >{{ $u->username }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Event</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="event" id="event" placeholder="" value="{{ old('event') }}">
                  </div>
                </div>
                                 
              </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
                <div class="btn-group pull-right">
                  <a href="{{ url('/vendors') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
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

@endsection

@section('other-js')
    <script src="{{ asset('vendor/formvalidation/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/framework/bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ asset('js/karyawanTetap.js') }}"></script>
      
    <!-- page script -->
    <script type="text/javascript">
    // $(document).ready(function() {
    //     validations.init();
    // });
    </script>
    <script type="text/javascript">

    $('.date').datepicker({  

       format: 'mm-dd-yyyy'

     });  

</script>  
@endsection
