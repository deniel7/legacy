@extends('layouts.backend')
@section('title', 'Add Package Taken')
@section('other-css')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/formValidation.css') }}">
<!-- bootstrap select -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endsection

@section('content')
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Package
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
            <form class="form-horizontal" id="frmData" method="post" action="{{ url('/package-taken') }}" autocomplete="off">
              <input type="hidden" class="form-control" name="id" id="id" value="{{ $id }}">
              {{ csrf_field() }}
              
              <div class="box-body">
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Package *</label>
                  <div class="col-sm-10">
                    <select name="package_id" id="package_id" class="form-control selectpicker" title="-- Choose Package --">
                      @foreach($packages as $item)
                        <option value="{{ $item->id }}" {{ $item->id == old('package_id') ? 'selected' : '' }} >{{ $item->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                    
                  </div>
                
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Vendor *</label>
                  <div class="col-sm-10">
                    <select name="vendor_id" id="vendor_id" class="form-control selectpicker" title="-- Choose Vendor --">
                      @foreach($vendors as $item)
                        <option value="{{ $item->id }}" {{ $item->id == old('vendor_id') ? 'selected' : '' }} >{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                    
                  </div>
                
                <div class="form-group">
                  <label for="nik" class="col-sm-2 control-label">Keterangan *</label>
                  <div class="col-sm-10">
                   

                    <textarea id="editor1" class="ckeditor" name="keterangan"></textarea> 
                  </div>
                </div>                                
              </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
                <div class="btn-group pull-right">
                  <a href="{{ url('/package_taken/'.$id) }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
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
  CKEDITOR.replace('editor1', {
    filebrowserUploadUrl: "{{route('NewsController.upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});
</script>


@endsection
