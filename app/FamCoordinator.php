<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamCoordinator extends Model
{
    protected $fillable = ['user_id','photo_coord', 'photocoord_num', 'photo_coord_bride', 'photocoord_bride_num','lunchmeal','lunchmeal_num','lunchmeal_bride','lunchmeal_bride_num','gift_angpao_coord','gift_angpao_num'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
