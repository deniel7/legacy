@extends('layouts.client')
@section('content')
<!-- Portfolio Grid Section -->
<div class="row">
    <div class="col-xs-8">
        <h3 class="section-subheading">Wedding Data</h3>
        <hr/>
        <h2>Family Coordinator</h2>
        <hr/>
        <h4>Photo Session</h4>
        <form class="form-horizontal" id="frmData" method="post" action="{{ url('/post-famcoord') }}" autocomplete="off">
              {{ csrf_field() }}
              <input type="hidden" class="form-control" name="user_id" value="{{ $user_id }}">
        <div class="row">
        <div class="col-md-6">
            <label>Photo Session Coordinator (from Groom Fam)</label>
        </div>
        <div class="col-md-6">
            <label>Mobile Number Photo Coordinator (from Groom Fam)</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->photo_coord)) {
                $pc = json_decode($weddings->photo_coord);
                for ($i = 0; $i < count($pc); ++$i) {
                    echo "<input type='text' class='form-control' name='photo_coord[]' value='".$pc[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="photo_coord[]">
            <input type="text" class="form-control" name="photo_coord[]">
            <?php  } ?>                                                                                                                                                                                                                                                                                                                
        </div>
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->photocoord_num)) {
                $pcn = json_decode($weddings->photocoord_num);
                for ($i = 0; $i < count($pcn); ++$i) {
                    echo "<input type='text' class='form-control' name='photocoord_num[]' value='".$pcn[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="photocoord_num[]" >
            <input type="text" class="form-control" name="photocoord_num[]" >
             <?php  } ?>        
            
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label>Photo Session Coordinator (from Bride Fam)</label>
        </div>
        <div class="col-md-6">
            <label>Mobile Number Photo Coordinator (from Bride Fam)</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->photo_coord_bride)) {
                $pcb = json_decode($weddings->photo_coord_bride);
                for ($i = 0; $i < count($pcb); ++$i) {
                    echo "<input type='text' class='form-control' name='photo_coord_bride[]' value='".$pcb[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="photo_coord_bride[]">
            <input type="text" class="form-control" name="photo_coord_bride[]">
            
            
            <?php } ?>                                                                                                                                                                                                                                                                                                                  
        </div>
        <div class="col-md-6">
            <?php
                
            if (!empty($weddings->photocoord_bride_num)) {
                $pbn = json_decode($weddings->photocoord_bride_num);
                for ($i = 0; $i < count($pbn); ++$i) {
                    echo "<input type='text' class='form-control' name='photocoord_bride_num[]' value='".$pbn[$i]."'>";
                }
            } else {
            ?>
            <input type="text" class="form-control" name="photocoord_bride_num[]">
            <input type="text" class="form-control" name="photocoord_bride_num[]">
            
            <?php   } ?>                                                                                                                                                                                                                                                                                                           
            
        </div>
        </div>

        <div class="row">
            <hr/>
            <h4>Lunch & Meal Coordinator</h4>
            <div class="row">
        <div class="col-md-6">
            <label>Lunch & Meal (from Groom Fam)</label>
        </div>
        <div class="col-md-6">
            <label>Mobile Number Lunch & Meal (from Groom Fam)</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->lunchmeal)) {
                $lm = json_decode($weddings->lunchmeal);
                for ($i = 0; $i < count($lm); ++$i) {
                    echo "<input type='text' class='form-control' name='lunchmeal[]' value='".$lm[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="lunchmeal[]">
            <input type="text" class="form-control" name="lunchmeal[]">
            <?php  } ?>                                                                                                                                                                                                                                                                                                                
        </div>
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->lunchmeal_num)) {
                $lmn = json_decode($weddings->lunchmeal_num);
                for ($i = 0; $i < count($lmn); ++$i) {
                    echo "<input type='text' class='form-control' name='lunchmeal_num[]' value='".$lmn[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="lunchmeal_num[]" >
            <input type="text" class="form-control" name="lunchmeal_num[]" >
             <?php  } ?>        
            
        </div>
        </div>

        <br/>

        <div class="row">
        <div class="col-md-6">
            <label>Lunch & Meal Coordinator (from Bride Fam)</label>
        </div>
        <div class="col-md-6">
            <label>Mobile Number Lunch & Meal (from Bride Fam)</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->lunchmeal_bride)) {
                $lmb = json_decode($weddings->lunchmeal_bride);
                for ($i = 0; $i < count($lmb); ++$i) {
                    echo "<input type='text' class='form-control' name='lunchmeal_bride[]' value='".$lmb[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="lunchmeal_bride[]">
            <input type="text" class="form-control" name="lunchmeal_bride[]">
            
            
            <?php } ?>                                                                                                                                                                                                                                                                                                                  
        </div>
        <div class="col-md-6">
            <?php
                
            if (!empty($weddings->lunchmeal_bride_num)) {
                $lbn = json_decode($weddings->lunchmeal_bride_num);
                for ($i = 0; $i < count($lbn); ++$i) {
                    echo "<input type='text' class='form-control' name='lunchmeal_bride_num[]' value='".$lbn[$i]."'>";
                }
            } else {
            ?>
            <input type="text" class="form-control" name="lunchmeal_bride_num[]">
            <input type="text" class="form-control" name="lunchmeal_bride_num[]">
            
            <?php   } ?>                                                                                                                                                                                                                                                                                                           
            
        </div>
        </div>

        <div class="row">
        <hr/>
        <h4>Gift & Angpao Coordinator</h4>
        <div class="col-md-6">
            <label>Gift & Angpao Coordinator</label>
        </div>
        <div class="col-md-6">
            <label>Mobile Number Gift & Angpao Coordinator</label>
        </div>
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->gift_angpao_coord)) {
                $ga = json_decode($weddings->gift_angpao_coord);
                for ($i = 0; $i < count($ga); ++$i) {
                    echo "<input type='text' class='form-control' name='gift_angpao_coord[]' value='".$ga[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="gift_angpao_coord[]">
            <input type="text" class="form-control" name="gift_angpao_coord[]">
            
            
            <?php } ?>                                                                                                                                                                                                                                                                                                                  
        </div>
        <div class="col-md-6">
            <?php
                
            if (!empty($weddings->gift_angpao_num)) {
                $gan = json_decode($weddings->gift_angpao_num);
                for ($i = 0; $i < count($gan); ++$i) {
                    echo "<input type='text' class='form-control' name='gift_angpao_num[]' value='".$gan[$i]."'>";
                }
            } else {
            ?>
            <input type="text" class="form-control" name="gift_angpao_num[]">
            <input type="text" class="form-control" name="gift_angpao_num[]">
            
            <?php   } ?>                                                                                                                                                                                                                                                                                                           
            
        </div>
        </div>

        <br/>
        <div class="box-footer">
                <div class="btn-group pull-left">
                <a href="{{ url('wedding-data-bestmen') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Back</p></button>
                </div>          
                <div class="btn-group pull-right">
                  
                  <button type="submit" class="navbar-brand btn btn-primary" id="btnSubmit"><i class="fa fa-check"></i> Save</button>&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('wedding-data-guest-welcoming') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Next</p></button>
                </div>
              </div>

    </div>

    </div>
    
    
</div>
@stop