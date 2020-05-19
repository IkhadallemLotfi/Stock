<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Exports\ProduitsExport;
use App\Imports\ProduitsImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Fournisseur;
use Config;
use Log;
class FournisseurController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function getListeFournisseur(){
        return Fournisseur::get();
    }
    public function deleteFournisseur(Request $request){
        Fournisseur::where('fournisseur',$request->fournisseur)
                    ->delete();
    }

    public function addFournisseur(Request $request){
        $exists = Fournisseur::where('fournisseur', $request->fournisseur)
                    ->exists();
        if(!$exists){
            Fournisseur::insert([
                'fournisseur' => $request->fournisseur,
                'created_at' => Carbon::now()
            ]);
        }
    }

}
