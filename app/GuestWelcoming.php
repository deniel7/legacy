<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestWelcoming extends Model
{
    protected $fillable = ['user_id','groom_gw', 'groom_gw_num', 'brides_gw', 'brides_gw_num'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
