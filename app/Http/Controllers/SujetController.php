<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sujet;
use App\TypeSujet;
use App\Reaction;
use Auth;
use App\User;

class SujetController extends Controller
{
    //

    public function getSujet($id)
    {
        $sujet = Sujet::find($id);
        $user=$sujet->user;
        $reactions = $sujet->reactions;
        $react = $this->getReactTotal($reactions);
        $reponses = $sujet->reponses;
        $reponseUsers = [];
        $i = 0;
        foreach ($reponses as $reponse) {
            $reponseUsers[$i++] = $reponse->user;
        }
        $sujet->vues++;
        $sujet->save();
        
        if (Auth::user()) {
            $reaction = Reaction::where("sujet_id", $id)->where("user_id", Auth::user()->id)->get();
            
        }
        if ($reaction) {
            //$reaction=$reaction;
            return response()->json([
                'sujet' => $sujet, 'reaction' => $reaction, 'reactionNumber' => $react, 'reponsesUsers' => $reponseUsers
            ]);
        }else{
            return response()->json([
                'sujet' => $sujet, 'reaction' => 0, 'reactionNumber' => $react, 'reponsesUsers' => $reponseUsers
            ]);
        }
        
        
    }
    public function getReactTotal($reactions)
    {
        $react = 0;
        foreach ($reactions as $reaction) {
            $react = $react + $reaction->react;
        }
        return $react;
    }
    public function getReponseCount($sujet)
    {
        if ($sujet->reponses->count()) {
            return $sujet->reponses->count();
        } else {
            return 0;
        }
    }
    public function getActivite($sujet)
    {
        if ($this->getReponseCount($sujet)) {
            return $sujet->reponses->max('created_at');
        } else {
            return "-";
        }
    }
    public function getSujetsByType($id)
    {
        $sujets = TypeSujet::find($id)->sujets;
        $users = [];
        $react = [];
        $reponses = [];
        $activites = [];
        $i = 0;
        foreach ($sujets as $sujet) {
            $reactions = $sujet->reactions;
            $react[$i] = $this->getReactTotal($reactions);
            $reponses[$i] = $this->getReponseCount($sujet);
            $activites[$i] = $this->getActivite($sujet);
            $users[$i] = $sujet->user;
            $i++;
        }
        return response()->json(['sujets' => $sujets, 'users' => $users, 'reactions' => $react, 'reponses' => $reponses, 'activites' => $activites]);
    }
    public function getSujets()
    {
        $sujets = Sujet::All();
        $users = [];
        $react = [];
        $reponses = [];
        $activites = [];
        $i = 0;
        foreach ($sujets as $sujet) {
            $reactions = $sujet->reactions;
            $react[$i] = $this->getReactTotal($reactions);
            $reponses[$i] = $this->getReponseCount($sujet);
            $activites[$i] = $this->getActivite($sujet);
            $users[$i] = $sujet->user;
            $i++;
        }
        return response()->json(['sujets' => $sujets, 'users' => $users, 'reactions' => $react, 'reponses' => $reponses, 'activites' => $activites]);
    }
    public function index()
    {
        $sujets = Sujet::all();
        return view('forum.index', ['sujets' => $sujets]);
    }

    public function store(Request $request)
    {
        $sujet = new Sujet();
        $sujet->question = $request->question;
        $sujet->description = $request->description;
        $sujet->type_sujet_id = $request->type_id;
        if (Auth::user()) {
            $sujet->user_id = Auth::user()->id;
        } else {
            $sujet->user_id = 3;
        }
        $sujet->save();
        //return view('forum.index');
        $user = $sujet->user;
        return response()->json(['sujet' => $sujet, 'user' => $user]);
    }
    public function create()
    { }
    public function show()
    { }
    public function update()
    { }
    public function edit()
    { }
    public function destroy()
    { }
}
