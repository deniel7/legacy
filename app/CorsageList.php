<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorsageList extends Model
{
    protected $fillable = ['user_id','groom_name', 'bride_name'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
