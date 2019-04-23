<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reponse;
use Auth;


class ReponseController extends Controller
{
    //

    public function getReponses($id)
    {
        
    }
    public function Store(Request $request)
    {
        $reponse=new Reponse();
        $reponse->reponse=$request->rep;
        $reponse->sujet_id= $request->sujet_id;
        if (Auth::user()) {
            $reponse->user_id = Auth::user()->id;
        } else {
            $reponse->user_id = 3;
        }
        $user = $reponse->user;
        $reponse->save();
        return response()->json(['reponse' => $reponse, 'user' => $user]);
    }

}
