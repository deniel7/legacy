@extends('layouts.client')
@section('content')
<!-- Portfolio Grid Section -->
<div class="row">
    <div class="col-xs-8">
        <h3 class="section-subheading">Wedding Data</h3>
        <hr/>
        <h2>Friend Photo Session List</h2>
        
        <form class="form-horizontal" id="frmData" method="post" action="{{ url('/post-friendphotolist') }}" autocomplete="off">
            {{ csrf_field() }}
            <input type="hidden" class="form-control" name="user_id" value="{{ $user_id }}">
            
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label"><u>From Groom's Family</u></label><br/>
                    <label class="control-label">Name of VIP GUEST</label>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><u>From Bride's Family</u></label><br/>
                    <label class="control-label">Name of VIP GUEST</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    
                    if (!empty($weddings->groom_vip)) {
                    $groom_vip = json_decode($weddings->groom_vip);
                    for ($i = 0; $i < count($groom_vip); ++$i) {
                    echo "<input type='text' class='form-control' name='groom_vip[]' value='".$groom_vip[$i]."'>";
                    }
                    } else {
                    ?>
                    <input type="text" class="form-control" name="groom_vip[]">
                    <input type="text" class="form-control" name="groom_vip[]">
                    <input type="text" class="form-control" name="groom_vip[]">
                    <input type="text" class="form-control" name="groom_vip[]">
                    <input type="text" class="form-control" name="groom_vip[]">
                    <input type="text" class="form-control" name="groom_vip[]">

                    
                    <?php                                                                                                                                                                                                                                                                                                                         } ?>
                    
                </div>
                <div class="col-md-6">
                    <?php
                    
                    if (!empty($weddings->bride_vip)) {
                    $bride_vip = json_decode($weddings->bride_vip);
                    for ($i = 0; $i < count($bride_vip); ++$i) {
                    echo "<input type='text' class='form-control' name='bride_vip[]' value='".$bride_vip[$i]."'>";
                    }
                    } else {
                    ?>
                    <input type="text" class="form-control" name="bride_vip[]">
                    <input type="text" class="form-control" name="bride_vip[]">
                    <input type="text" class="form-control" name="bride_vip[]">
                    <input type="text" class="form-control" name="bride_vip[]">
                    <input type="text" class="form-control" name="bride_vip[]">
                    <input type="text" class="form-control" name="bride_vip[]">
                    <input type="text" class="form-control" name="bride_vip[]">
                    <?php                                                                                                                                                                                                                                                                                                                         }?>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    
                    <label class="control-label">Name of Friends</label>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Name of Friends</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    
                    if (!empty($weddings->groom_friend)) {
                    $groom_friend = json_decode($weddings->groom_friend);
                    for ($i = 0; $i < count($groom_friend); ++$i) {
                    echo "<input type='text' class='form-control' name='groom_friend[]' value='".$groom_friend[$i]."'>";
                    }
                    } else {
                    ?>
                    <input type="text" class="form-control" name="groom_friend[]">
                    <input type="text" class="form-control" name="groom_friend[]">
                    <input type="text" class="form-control" name="groom_friend[]">
                    <input type="text" class="form-control" name="groom_friend[]">
                    <input type="text" class="form-control" name="groom_friend[]">
                    <input type="text" class="form-control" name="groom_friend[]">
                    <input type="text" class="form-control" name="groom_friend[]">

                    
                    <?php                                                                                                                                                                                                                                                                                                                         } ?>
                    
                </div>
                <div class="col-md-6">
                    <?php
                    
                    if (!empty($weddings->bride_friend)) {
                    $bride_friend = json_decode($weddings->bride_friend);

                    for ($i = 0; $i < count($bride_friend); ++$i) {
                    echo "<input type='text' class='form-control' name='bride_friend[]' value='".$bride_friend[$i]."'>";
                    }
                    } else {
                    ?>
                    <input type="text" class="form-control" name="bride_friend[]">
                    <input type="text" class="form-control" name="bride_friend[]">
                    <input type="text" class="form-control" name="bride_friend[]">
                    <input type="text" class="form-control" name="bride_friend[]">
                    <input type="text" class="form-control" name="bride_friend[]">
                    <input type="text" class="form-control" name="bride_friend[]">
                    <input type="text" class="form-control" name="bride_friend[]">
                    <?php                                                                                                                                                                                                                                                                                                                         }?>
                    
                </div>
            </div>
            
        <br/>
        <div class="box-footer">
            <div class="btn-group pull-left">
                <a href="{{ url('wedding-data-corsagelist') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Back</p></button>
            </div>
            <div class="btn-group pull-right">
                
                <button type="submit" class="navbar-brand btn btn-primary" id="btnSubmit"><i class="fa fa-check"></i> Save</button>&nbsp;&nbsp;&nbsp;
                
            </div>
        </div>
    </div>
</div>


</div>
@stop