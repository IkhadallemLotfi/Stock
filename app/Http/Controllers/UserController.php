<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use Config;
use Log;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function listeUsers(){
        $users = DB::table('users')->get();
        return $users;
    }

    public function addUser(Request $request){
        if(Auth::User()->role > 0){
            $exists = DB::table('users')->where('email',$request->email)
                                        ->exists();
            if(!$exists){ 
                User::insert([
                    'email' => $request->email,
                    'name' => $request->nom,
                    'prenom' => $request->prenom,
                    'etat_compte' => 1,
                    'password' =>  Hash::make('pharm'), 
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }

    public function changePassword(Request $request){
        //changer le mot de passe de l'utilisateur
        $old = $request->old;
        $new = $request->new;
        $repeat = $request->repeat;

        if( Hash::check($old,Auth::user()->getHashedPass() ) ){
            if($new == $repeat){
                Auth::user()->setPassword($new);
            }
        }else {
            return Response::json(array(
                'code'      =>  401,
                'message'   => 'Mot de passe incorrect' 
                ),401);
        }
    }

    public function updateUser(Request $request){
        $userID = Auth::user()->id;
        DB::table('users')->where('id',$userID) 
        ->update([
            'email' => $request->email,
            'name' => $request->name,
            'prenom' => $request->prenom,
            'updated_at' => Carbon::now(),
        ]);
    }
}
