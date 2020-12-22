<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cohensive\Embed\Facades\Embed;

class NewsletterHeader extends Model
{
    public function NewsletterDetail()
    {
        return $this->hasMany('App\NewsletterDetail');
    }
}
