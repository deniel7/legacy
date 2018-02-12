@extends('layouts.client')
@section('content')
<!-- Portfolio Grid Section -->
<div class="row">
    <div class="col-xs-8">
        <h3 class="section-subheading">Wedding Data</h3>
        <hr/>
        <h2>Tea Pay</h2>
        
        <form class="form-horizontal" id="frmData" method="post" action="{{ url('/post-teapay') }}" autocomplete="off">
            {{ csrf_field() }}
            <input type="hidden" class="form-control" name="user_id" value="{{ $user_id }}">
            
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label"><u>From Groom's Family</u></label>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><u>From Bride's Family</u></label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    
                    if (!empty($weddings->groom_name)) {
                    $gr_name = json_decode($weddings->groom_name);
                    for ($i = 0; $i < count($gr_name); ++$i) {
                    echo "<input type='text' class='form-control' name='groom_name[]' value='".$gr_name[$i]."'>";
                    }
                    } else {
                    ?>
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <input type="text" class="form-control" name="groom_name[]">
                    <?php                                                                                                                                                                                                                                                                                                                         } ?>
                    
                </div>
                <div class="col-md-6">
                    <?php
                    
                    if (!empty($weddings->bride_name)) {
                    $bride_name = json_decode($weddings->bride_name);
                    for ($i = 0; $i < count($bride_name); ++$i) {
                    echo "<input type='text' class='form-control' name='bride_name[]' value='".$bride_name[$i]."'>";
                    }
                    } else {
                    ?>
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <input type="text" class="form-control" name="bride_name[]">
                    <?php                                                                                                                                                                                                                                                                                                                         }?>
                    
                </div>
            </div>
            
        <br/>
        <div class="box-footer">
            <div class="btn-group pull-left">
                <a href="{{ url('wedding-data-guestbookangpao') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Back</p></button>
            </div>
            <div class="btn-group pull-right">
                
                <button type="submit" class="navbar-brand btn btn-primary" id="btnSubmit"><i class="fa fa-check"></i> Save</button>&nbsp;&nbsp;&nbsp;
                <a href="{{ url('wedding-data-corsagelist') }}"><button type="button" class="navbar-brand btn btn-default pull-right"><p>Next</p></button>
            </div>
        </div>
    </div>
</div>


</div>
@stop