@extends('layouts.backend')
@section('title', 'Projects')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Project
  <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li><a href="#">Master</a></li>
    <li><a href="{{ url('/couple') }}">Project</a></li>
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
          <div class="btn-group">
          
                @if (in_array(111, session()->get('allowed_menus')))
                <a href="{{ url('/couple/create/') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                @endif
              </div>
          <br><br>
          
          <div class="table-responsive">
          <!-- 
            Tambahkan style : table-layout fixed untuk bisa atur width column
             -->
            <table id="datatable" style="" width="100%" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>User</th>
                  <th>Pengantin Pria</th>
                  <th>Pengantin Wanita</th>
                  <th width="20%">Details</th>
                  
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <tr>
                  <th>User</th>
                  <th>Pengantin Pria</th>
                  <th>Pengantin Wanita</th>
                  
                  
                <th></th>
                
              </tr>
              </tfoot>
            </table>
          </div>
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
@include('couple.partials.add_modal')
@include('couple.partials.show_detail_modal')
@include('couple.partials.lembur_modal')

<!-- page script -->
<style>
.datepicker{z-index:1151 !important;}
</style>
<script type="text/javascript">
$(document).ready(function(){
coupleModule.init();
});
</script>
@endsection