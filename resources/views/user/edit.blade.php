@extends('layouts.backend')

@section('other-css')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/formValidation.css') }}">
@endsection

@section('content')
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>Edit</small>
      </h1>
        
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('/users') }}"> Users</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
      
      <div class="row">
        
        <div class="col-xs-12">
          
          <div class="box box-primary">
            
            <div class="box-header with-border">
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            
            <!-- form start -->
            <form class="form-horizontal" id="frmData" method="post" action="{{ url('/users') }}/{{ $user->id }}" autocomplete="off">
              
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              
              <div class="box-body">
                
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username') !== null ? old('username') : $user->username }}" placeholder="Nama">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') !== null ? old('email') : $user->email }}" placeholder="Nama">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Pengantin pria</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="pengantin_pria" id="pengantin_pria" value="{{ old('pengantin_pria') !== null ? old('email') : $user->pengantin_pria }}" placeholder="Nama">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Pengantin wanita</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="pengantin_wanita" id="pengantin_wanita" value="{{ old('pengantin_wanita') !== null ? old('email') : $user->pengantin_wanita }}" placeholder="Nama">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                  <select name="active" id="active" class="form-control selectpicker" title="-- Pilih angkutan --">
                      @foreach($status_users as $item)
                        <option value="{{ $item->active }}" {{ $item->active == (old('$user->active') !== null ? old('$user->active') : $user->active) ? 'selected' : '' }} >@if ($item->active == 1)Active @else not Active @endif</option>
                      @endforeach
                    </select>

                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
                <div class="pull-right">
                  <a href="{{ url('/angkutan') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Back</a>
                  <button type="submit" class="btn btn-primary" id="btnSubmit"><i class="fa fa-refresh"></i> Update</button>
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
    
@endsection
<script type="text/javascript">
    $(document).ready(function(){
    userModule.init();
    });
    </script>
