<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsletterDetail extends Model
{
    protected $fillable = ['id', 'newsletter_header_id', 'Description', 'link_youtube'];

    public function header()
    {
        return $this->belongsTo('App\NewsletterHeader');
    }
}
