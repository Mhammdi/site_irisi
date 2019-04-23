<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeSujet;
use App\Sujet;

class TypeSujetController extends Controller
{
    //
    public function getSujet($id){

        $sujets=TypeSujet::find($id)->sujets;
        //$sujets=Sujet::where('type_id',$id)->get();
        return $sujets;
    }
    public function index(){
        $typesujets=TypeSujet::all();
        return view('forum.index',['typesujets'=>$typesujets]);
    }
    public function getTypes(){
        $typesujets=TypeSujet::all();
        return $typesujets;
    }
    public function getType($id){
       
        $Type=TypeSujet::find($id);
        //$sujets=Sujet::where();
        //$typesujets=TypeSujet::find($id);
        //return $sujets;
        //return $sujets;
        
        return view('forum.forum_type',['types' => $Type]);
    }
    public function Type($id){
       
        $Type=TypeSujet::find($id);
        $typesujets=TypeSujet::all();
        return $Type;
        //$sujets=Sujet::where();
        //$typesujets=TypeSujet::find($id);
        //return $sujets;
        //return $sujets;
        //return $Type;
        //return view('forum.forum_type',['types' => $Type]);
        //return view('forum.forum_type',['types' => $Type]);
    }

    public function store(){
       

    }
}
