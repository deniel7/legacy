@extends('layouts.client')
@section('content')
<!-- Portfolio Grid Section -->
<div class="row">
    <div class="col-xs-8">
        <h3 class="section-subheading">Wedding Data</h3>
        <hr/>
        <h2>Best Men & Brides Maid</h2>
        <form class="form-horizontal" id="frmData" method="post" action="{{ url('/post-bestmen') }}" autocomplete="off">
              {{ csrf_field() }}
              <input type="hidden" class="form-control" name="user_id" value="{{ $user_id }}">
        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Name of Bestmen</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Bestmen Mobile Number</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->name_bestmen)) {
                $bs = json_decode($weddings->name_bestmen);
                for ($i = 0; $i < count($bs); ++$i) {
                    echo "<input type='text' class='form-control' name='name_bestmen[]' value='".$bs[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="name_bestmen[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name_bestmen[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name_bestmen[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name_bestmen[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name_bestmen[]" value="{{ old('name') }}">
            <?php                                                                                                                                                                                                                                                                                                                         } ?>
            
        </div>
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->bestmen_num)) {
                $bn = json_decode($weddings->bestmen_num);
                for ($i = 0; $i < count($bn); ++$i) {
                    echo "<input type='text' class='form-control' name='bestmen_num[]' value='".$bn[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="bestmen_num[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="bestmen_num[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="bestmen_num[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="bestmen_num[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="bestmen_num[]" value="{{ old('name') }}">
            <?php                                                                                                                                                                                                                                                                                                                         }?>
            
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Name of Brides Maid</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Brides Maid Mobile Number</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->name_bridesmaid)) {
                $bridesmaid = json_decode($weddings->name_bridesmaid);
                for ($i = 0; $i < count($bridesmaid); ++$i) {
                    echo "<input type='text' class='form-control' name='name_bridesmaid[]' value='".$bridesmaid[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="name_bridesmaid[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name_bridesmaid[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name_bridesmaid[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name_bridesmaid[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name_bridesmaid[]" value="{{ old('name') }}">
            
            <?php                                                                                                                                                                                                                                                                                                                         } ?>
        </div>
        <div class="col-md-6">
            <?php
                
            if (!empty($weddings->bridesmaid_num)) {
                $b_num = json_decode($weddings->bridesmaid_num);
                for ($i = 0; $i < count($b_num); ++$i) {
                    echo "<input type='text' class='form-control' name='bridesmaid_num[]' value='".$b_num[$i]."'>";
                }
            } else {
            ?>
            <input type="text" class="form-control" name="bridesmaid_num[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="bridesmaid_num[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="bridesmaid_num[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="bridesmaid_num[]" value="{{ old('name') }}">
            <input type="text" class="form-control" name="bridesmaid_num[]" value="{{ old('name') }}">
            <?php                                                                                                                                                                                                                                                                                                                         } ?>
            
        </div>
        </div>

        <br/>
        <div class="box-footer">
                <div class="btn-group pull-left">
                <a href="{{ url('wedding-data') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Back</p></button>
                </div>                
                <div class="btn-group pull-right">
                  
                  <button type="submit" class="navbar-brand btn btn-primary" id="btnSubmit"><i class="fa fa-check"></i> Save</button>&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('wedding-data-famcoord') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Next</p></button>
                </div>
              </div>

    </div>

    </div>
    
    
</div>
@stop