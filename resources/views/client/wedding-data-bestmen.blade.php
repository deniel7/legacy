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
            <label class="control-label">Name of Bestmen</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Bestmen Mobile Number</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            
            
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            
            
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
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            
            
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            
            
        </div>
        </div>

    </div>
    
    
</div>
@stop