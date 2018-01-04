@extends('layouts.backend')
@section('title', 'Package Taken')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Package Taken
  <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li><a href="#">Master</a></li>
    <li><a href="{{ url('/package_taken') }}">Package Taken</a></li>
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
                <a href="{{ url('/package-taken/'.$id.'/create/') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
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
                  <th>Package</th>
                  <th>Vendor</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th width="20%">Action</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach($projects as $p)
                <tr>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->created_at }}</td>
                <td>{{ $p->updated_at }}</td>
                
                <td><a href="{{ url('couple/'.$p->id.'/edit') }}"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button></a></td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                  <th>Package</th>
                  <th>Vendor</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  
                  
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

@endsection