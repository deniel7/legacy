<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendPhotoList extends Model
{
    protected $fillable = ['user_id','groom_vip', 'bride_vip','groom_friend', 'bride_friend'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
