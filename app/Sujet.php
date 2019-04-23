<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TypeSujet;

class Sujet extends Model
{

    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function type()
    {
        return $this->belongsTo('App\TypeSujet');
    }
    public function reactions()
    {
        return $this->hasMany('App\Reaction');
    }
    public function reponses()
    {
        return $this->hasMany('App\Reponse')->orderBy('created_at','desc');
    }
}
