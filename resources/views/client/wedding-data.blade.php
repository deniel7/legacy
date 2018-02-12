@extends('layouts.client')
@section('content')
<!-- Portfolio Grid Section -->
<div class="row">
    <div class="col-xs-8">
        <h3 class="section-subheading">Wedding Data</h3>
        <hr/>
        <form class="form-horizontal" id="frmData" method="post" action="{{ url('/post-wedding-data') }}" autocomplete="off">
              {{ csrf_field() }}
              <input type="hidden" class="form-control" name="user_id" value="{{ $user_id }}">
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
            <input type="text" class="form-control" name="name_groom" value="{{ isset($weddings->name_groom) ? $weddings->name_groom : '' }}">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="name_bride" value="{{ isset($weddings->name_bride) ? $weddings->name_bride : '' }}">
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
            <input type="text" class="form-control" name="groom_mobile" value="{{ isset($weddings->groom_mobile_num) ? $weddings->groom_mobile_num : '' }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="bride_mobile" value="{{ isset($weddings->bride_mobile_num) ? $weddings->bride_mobile_num : '' }}">         
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
            <input type="text" class="form-control" name="groom_email" value="{{ isset($weddings->groom_email) ? $weddings->groom_email : '' }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="bride_email" value="{{ isset($weddings->bride_email) ? $weddings->bride_email : '' }}">         
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Date of Groom birth</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Date of Bride birth</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
             
            <input class="form-control" id="exampleInputDOB" placeholder="Date of Birth" type="date" name="dob_groom" value="{{ isset($weddings->dob_groom) ? $weddings->dob_groom : '' }}">
        </div>
        <div class="col-md-6">
            <input class="form-control" id="exampleInputDOB1" placeholder="Date of Birth" type="date" name="dob_bride" value="{{ isset($weddings->dob_bride) ? $weddings->dob_bride : '' }}">  
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Groom Address</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Bride Address</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="groom_address" value="{{ isset($weddings->groom_address) ? $weddings->groom_address : '' }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="bride_address" value="{{ isset($weddings->bride_address) ? $weddings->bride_address : '' }}">         
        </div>
        </div>

        <br/>
        <hr/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Name of Groom Parents (Father)</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Name of Bride Parents (Father)</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="groom_father" value="{{ isset($weddings->name_groom_father) ? $weddings->name_groom_father : '' }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="bride_father" value="{{ isset($weddings->name_bride_father) ? $weddings->name_bride_father : '' }}">         
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Groom Parents (Father) Mobile Number</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Bride Parents (Father) Mobile Number</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="groom_father_mobile" value="{{ isset($weddings->groom_father_num) ? $weddings->groom_father_num : '' }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="bride_father_mobile" value="{{ isset($weddings->bride_father_num) ? $weddings->bride_father_num : '' }}">         
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Name of Groom Parents (Mother)</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Name of Bride Parents (Mother)</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="groom_mother" value="{{ isset($weddings->name_groom_mother) ? $weddings->name_groom_mother : '' }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="bride_mother" value="{{ isset($weddings->name_bride_mother) ? $weddings->name_bride_mother : '' }}">         
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Groom Parents (Mother) Mobile Number</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Bride Parents (Mother) Mobile Number</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="groom_mother_mobile" value="{{ isset($weddings->groom_mother_num) ? $weddings->groom_mother_num : '' }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="bride_mother_mobile" value="{{ isset($weddings->bride_mother_num) ? $weddings->bride_mother_num : '' }}">         
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Name of Groom Siblings & Partner / Child</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Groom Siblings & Partner Mobile Number</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <?php
                
            if (!empty($weddings->groom_siblings)) {
                $c = json_decode($weddings->groom_siblings);
                for ($i = 0; $i < count($c); ++$i) {
                    //echo "- ".$c[$i]."<br/>";

                    echo "<input type='text' class='form-control' name='groom_siblings[]' value=".$c[$i].">";
                }
            } else {
            ?>
            
            
            <input type="text" class="form-control" name="groom_siblings[]" />
            <input type="text" class="form-control" name="groom_siblings[]" />
            <input type="text" class="form-control" name="groom_siblings[]" />
            <input type="text" class="form-control" name="groom_siblings[]" />
            
            <?php  } ?>                                                                                       
        </div>
        <div class="col-md-6">
            <?php
                
            if (!empty($weddings->groom_sibling_num)) {
                $gs_num = json_decode($weddings->groom_sibling_num);
                for ($i = 0; $i < count($gs_num); ++$i) {
                    //echo "- ".$c[$i]."<br/>";

                    echo "<input type='text' class='form-control' name='groom_siblings_number[]' value=".$gs_num[$i].">";
                }
            } else {
            ?>
            <input type="text" class="form-control" name="groom_siblings_number[]" />
            <input type="text" class="form-control" name="groom_siblings_number[]" />
            <input type="text" class="form-control" name="groom_siblings_number[]" />
            <input type="text" class="form-control" name="groom_siblings_number[]" />  

            <?php } ?>  
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Name of Bride Siblings & Partner / Child</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Bride Siblings & Partner Mobile Number</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <?php
                
            if (!empty($weddings->bride_siblings)) {
                $bs = json_decode($weddings->bride_siblings);
                for ($i = 0; $i < count($bs); ++$i) {
                    echo "<input type='text' class='form-control' name='bride_siblings[]' value=".$bs[$i].">";
                }
            } else {
            ?>
            <input type="text" class="form-control" name="bride_siblings[]" />
            <input type="text" class="form-control" name="bride_siblings[]" />
            <input type="text" class="form-control" name="bride_siblings[]" />
            <input type="text" class="form-control" name="bride_siblings[]" />    
            <?php } ?>
        </div>
        <div class="col-md-6">
            <?php
                
            if (!empty($weddings->bride_sibling_num)) {
                $bsn = json_decode($weddings->bride_sibling_num);
                for ($i = 0; $i < count($bsn); ++$i) {
                    echo "<input type='text' class='form-control' name='bride_siblings_number[]' value=".$bsn[$i].">";
                }
            } else {
            ?>
            <input type="text" class="form-control" name="bride_siblings_number[]" />
            <input type="text" class="form-control" name="bride_siblings_number[]" />
            <input type="text" class="form-control" name="bride_siblings_number[]" />
            <input type="text" class="form-control" name="bride_siblings_number[]" />
            <?php } ?>
        </div>
        </div>

        <br/>
        <hr/>

        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Name of Bride Grandparents</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Name of Groom Grandparents</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" name="bride_grandparents" value="{{ isset($weddings->bride_grandparents) ? $weddings->bride_grandparents : '' }}">  
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="groom_grandparents" value="{{ isset($weddings->groom_grandparents) ? $weddings->groom_grandparents : '' }}">         
        </div>
        </div>

        <br/>
        <div class="box-footer">
                <div class="btn-group pull-right">
                  
                  <button type="submit" class="navbar-brand btn btn-primary" id="btnSubmit"><i class="fa fa-check"></i> Save</button>&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('wedding-data-bestmen') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Next</p></button>
                </div>
              </div>

    </div>
    

@stop