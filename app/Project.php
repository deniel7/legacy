<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function packageTakens()
    {
        return $this->hasMany('App\PackageTaken');
    }
}
