<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function sujet(){
        return $this->belongsTo('App\Sujet');
    }
}
