@extends('layouts.backend')
@section('title', 'Master Karyawan Harian')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Absensi Harian
  <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li><a href="#">Master</a></li>
    <li><a href="{{ url('/karyawan-tetap') }}">Absensi Harian</a></li>
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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#absensi_modal">
                <i class="fa fa-upload fa-fw"></i> Upload Excel Absensi
                </button>
                 
                <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#lembur_modal">
                <i class="fa fa-upload fa-fw"></i> Upload Excel Lembur
                </button> -->
               
          </div>
          <div style="float:right">
          <a class="btn btn-primary" href="{{ url('/absensi-harian/tambah-absensi') }}"><i class="fa fa-check fa-plus"></i> Tambah Lembur</a>
          </div>
          <br><br>
          
          <div class="table-responsive">
          <!-- 
            Tambahkan style : table-layout fixed untuk bisa atur width column
             -->
            <table id="datatable" style="" width="100%" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th>Client</th>
                  
                  <th width="10%">Actions</th>
                  
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <tr>
                  <th>Client</th>
                  
                  
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