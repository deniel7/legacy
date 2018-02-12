@extends('layouts.client')
@section('content')
<!-- Portfolio Grid Section -->
<div class="row">
    <div class="col-xs-8">
        <h3 class="section-subheading">Wedding Data</h3>
        <hr/>
        <h2>Family Coordinator</h2>
        <hr/>
        <h4>Guest Welcoming (Penerima Tamu)</h4>

        <form class="form-horizontal" id="frmData" method="post" action="{{ url('/post-guestwelcoming') }}" autocomplete="off">
              {{ csrf_field() }}
              <input type="hidden" class="form-control" name="user_id" value="{{ $user_id }}">
        <div class="row">
         <div class="col-md-6">
        <label class="control-label"><u>From Groom's Family</u></label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <label class="control-label">Name of Guest Welcoming</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Mobile Number of Guest Welcoming</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->groom_gw)) {
                $gr_gw = json_decode($weddings->groom_gw);
                for ($i = 0; $i < count($gr_gw); ++$i) {
                    echo "<input type='text' class='form-control' name='groom_gw[]' value='".$gr_gw[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="groom_gw[]">
            <input type="text" class="form-control" name="groom_gw[]">
            <input type="text" class="form-control" name="groom_gw[]">
            <input type="text" class="form-control" name="groom_gw[]">
            <input type="text" class="form-control" name="groom_gw[]">
            <?php                                                                                                                                                                                                                                                                                                                         } ?>                                                                                                                                                                                                                                                                                                   
            
        </div>
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->groom_gw_num)) {
                $gw_num = json_decode($weddings->groom_gw_num);
                for ($i = 0; $i < count($gw_num); ++$i) {
                    echo "<input type='text' class='form-control' name='groom_gw_num[]' value='".$gw_num[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="groom_gw_num[]">
            <input type="text" class="form-control" name="groom_gw_num[]">
            <input type="text" class="form-control" name="groom_gw_num[]">
            <input type="text" class="form-control" name="groom_gw_num[]">
            <input type="text" class="form-control" name="groom_gw_num[]">
            <?php                                                                                                                                                                                                                                                                                                                         }?>                                                                                                                                                                                                                                                                                                                       
            
        </div>
        </div>

        <br/>
        <div class="row">
         <div class="col-md-6">
        <label class="control-label"><u>From Bride's Family</u></label>
        </div>
        </div>
        <div class="row">

        <div class="col-md-6">
            <label class="control-label">Name of Guest Welcoming</label>
        </div>
        <div class="col-md-6">
            <label class="control-label">Mobile Number of Guest Welcoming</label>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">

            <?php
                
            if (!empty($weddings->brides_gw)) {
                $bridesgw = json_decode($weddings->brides_gw);
                for ($i = 0; $i < count($bridesgw); ++$i) {
                    echo "<input type='text' class='form-control' name='brides_gw[]' value='".$bridesgw[$i]."'>";
                }
            } else {
            ?>

            <input type="text" class="form-control" name="brides_gw[]">
            <input type="text" class="form-control" name="brides_gw[]">
            <input type="text" class="form-control" name="brides_gw[]">
            <input type="text" class="form-control" name="brides_gw[]">
            <input type="text" class="form-control" name="brides_gw[]">
            
            <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 } ?>
        </div>
        <div class="col-md-6">
            <?php
                
            if (!empty($weddings->brides_gw_num)) {
                $brides_gw_num = json_decode($weddings->brides_gw_num);
                for ($i = 0; $i < count($brides_gw_num); ++$i) {
                    echo "<input type='text' class='form-control' name='brides_gw_num[]' value='".$brides_gw_num[$i]."'>";
                }
            } else {
            ?>
            <input type="text" class="form-control" name="brides_gw_num[]">
            <input type="text" class="form-control" name="brides_gw_num[]">
            <input type="text" class="form-control" name="brides_gw_num[]">
            <input type="text" class="form-control" name="brides_gw_num[]">
            <input type="text" class="form-control" name="brides_gw_num[]">
            <?php                                                                                                                                                                                                                                                                                                                          } ?>                                                                                                                                                                                                                                                                                                                      
            
        </div>
        </div>

        <br/>
        <div class="box-footer">
                <div class="btn-group pull-left">
                <a href="{{ url('wedding-data-famcoord') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Back</p></button>
                </div>                
                <div class="btn-group pull-right">
                  
                  <button type="submit" class="navbar-brand btn btn-primary" id="btnSubmit"><i class="fa fa-check"></i> Save</button>&nbsp;&nbsp;&nbsp;
                  <a href="{{ url('wedding-data-guestbookangpao') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Next</p></button>
                </div>
              </div>

    </div>

    </div>
    
    
</div>
@stop