<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function packageTakens()
    {
        return $this->hasMany('App\PackageTaken');
    }
}
