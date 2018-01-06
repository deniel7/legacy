@extends('layouts.backend')
@section('title', 'Contact')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Contact
  <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li><a href="#">Master</a></li>
    <li><a href="{{ url('/users') }}">Contact</a></li>
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
          
              <br><br>
          <div class="table-responsive">
          <!-- 
            Tambahkan style : table-layout fixed untuk bisa atur width column
             -->
            <table id="datatable" style="table-layout: fixed;" width="100%" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th width="20%">name</th>
                  <th width="30%">email</th>
                  <th width="20%">phone</th> 
                  <th width="20%">message</th>           
                  
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <tr>
                  <th width="20%">name</th>
                  <th width="30%">email</th>
                  <th width="20%">phone</th> 
                  <th width="20%">message</th>                
                  
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

<!-- page script -->
<script type="text/javascript">
$(document).ready(function(){
contactModule.init();
});
</script>
@endsection
