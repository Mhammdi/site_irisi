<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Reaction;

class ReactionController extends Controller
{
    //
    public function Store(Request $request)
    {
        if($request->react>0){
            $request->react = 1;
        }else if($request->react<0){
            $request->react = -1;
        }
        $reaction = Reaction::find($request->id);
        if ($reaction) {
            $reaction->react=$request->react;
         } else {
            $reaction = new Reaction();
            $reaction->react = $request->react;
            $reaction->sujet_id = $request->sujet_id;
            $reaction->user_id = Auth::user()->id;
        }
        $reaction->save();

        
        
        return response()->json(['reaction' => $reaction]);
        
    }
}
