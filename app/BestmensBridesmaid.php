<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BestmensBridesmaid extends Model
{
    protected $fillable = ['user_id','name_bestmen', 'bestmen_num', 'name_bridesmaid', 'bridesmaid_num'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
