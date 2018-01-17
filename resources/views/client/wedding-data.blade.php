@extends('layouts.client')
@section('content')
<!-- Portfolio Grid Section -->
<div class="row">
    <div class="col-xs-8">
        <h3 class="section-subheading">Wedding Data</h3>
        <hr/>
        <h2>Best Men & Brides Maid</h2>
        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Name of Groom</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Name of Bride</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Groom Mobile Number</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Brides Mobile Number</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">         
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Groom Email</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Brides Email</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">         
        </div>
        </div>

    </div>
    
    
</div>
@stop