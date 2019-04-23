<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sujet;

class TypeSujet extends Model
{
    //
    public function sujets(){
        return $this->hasMany('App\Sujet')->orderBy('created_at', 'desc');;
    }
}
