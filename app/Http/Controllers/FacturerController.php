<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\facture;
use App\entree;
use Config;
use Log;


class FacturerController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function addFacture(request $request){
        $exists = facture::where('numero',$request->numFacture)
                        ->exists();
        Debugbar::info($request);
        if( !$exists ){
            facture::insert([
                'numero' => $request->numFacture,
                'date_facture' => $request->dateFacture,
                'fournisseur' => $request->fournisseur, 
                'created_at' => Carbon::now(),
            ]);
            
            return [
                'code' => 200,
                'message' => '',
            ];
        }else{
            return [
                'code' => 400,
                'message' => 'Ce numéro existe déjà',
            ];
        }
    }

    public function updateFacture(Request $request){
        facture::where('numero',$request->numFacture)
                ->update([
                    'date_facture' => $request->dateFacture,
                    'fournisseur' => $request->fournisseur, 
                    'updated_at' => Carbon::now(),
                ]);
    }

    public function deleteFacture($facture){
        facture::where('numero',$facture)
                ->delete();
        entree::where('num_facture',$facture)
                ->delete();
    }

    public function getListeFacture(){
        $factures = facture::select(DB::raw('numero, fournisseur, date_facture, created_at, updated_at'))
                            ->get();
        foreach ($factures as $facture) {
            $entrees = DB::table('entrees')
                                        ->where('num_facture',$facture->numero)
                                        ->join('produits','id_produit','=','id')
                                        ->get();
            $montantTr = 0;
            $montantPpa = 0;
            $montantNet = 0;
            foreach ($entrees as $entree) {
                $montantNet = $montantNet + $entree->prix_net * $entree->quantite ;
                $montantPpa = $montantPpa + $entree->prix_ppa * $entree->quantite ;
                $montantTr = $montantTr + $entree->prix_tr * $entree->quantite ; 
            }
            $facture['montant_tr'] = $montantTr;
            $facture['montant_ppa'] = $montantPpa;
            $facture['montant_net'] = $montantNet;
        }
        return $factures ;
    }

    public function getListeProduitFacture($facture){
        $produits = DB::table('factures')->select(DB::raw('numero,fournisseur,designation,entrees.quantite,prix_ppa,prix_tr,prix_net'))
                                        ->join('entrees','num_facture','=','numero')
                                        ->join('produits','id_produit','=','id')
                                        ->where('numero',$facture)
                                        ->get();
         
        return $produits;
    }
}
