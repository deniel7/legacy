<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeddingData extends Model
{
    protected $fillable = ['user_id','name_groom', 'groom_mobile_num', 'groom_email', 'dob_groom', 'groom_address', 'name_bride', 'bride_mobile_num', 'bride_email', 'dob_bride', 'bride_address', 'name_groom_father', 'groom_father_num', 'name_groom_mother', 'groom_mother_num', 'name_bride_father', 'name_bride_mother', 'bride_father_num', 'groom_sibling_num', 'groom_siblings', 'bride_mother_num', 'bride_siblings', 'bride_grandparents', 'bride_sibling_num', 'groom_grandparents'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
