<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestbookAngpao extends Model
{
    protected $fillable = ['user_id','groom_name', 'groom_num', 'bride_name', 'bride_num'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
