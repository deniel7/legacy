<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTaken extends Model
{
    protected $fillable = ['project_id', 'package_id', 'vendor_id', 'keterangan'];

    public function package()
    {
        return $this->belongsTo('App\Package');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
