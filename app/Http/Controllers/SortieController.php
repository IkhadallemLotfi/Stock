<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\sortie;
use App\produit;
use App\Exports\ProduitExport;
use Maatwebsite\Excel\Facades\Excel;
use Config;
use Log;
class SortieController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function listeSorties(Request $request){
        return sortie::select(DB::raw('id, designation, date_peromption, date_sortie, prix_ppa, prix_tr,
                    prix_net, sorties.quantite, produits.quantite stock ,num_ordonnance, destination') )
                    ->join('produits','id_produit','=','id')
                    ->where('date_sortie',$request->dateSortie)
                    ->get();
    }


    public function newSortie(Request $request){
    // met à jour la quantité d'un produit déjà existant et l'enregistre aux entrées
        $maxMois = DB::table('sorties')->select(DB::raw('month(date_sortie) month, year(date_sortie) year, date_sortie'))
                                    ->orderby('date_sortie','desc')
                                    ->get();

        $tabDate = explode('-',$request->dateSortie);
        $newMois = false;
        if  ( sizeOf($maxMois) > 0 && ( ($tabDate[1] > $maxMois[0]->month && $tabDate[0] == $maxMois[0]->year ) 
            || ($tabDate[0] > $maxMois[0]->year) ) ){
            /////////NEW mois
            $produits = produit::select(DB::raw('id, designation, date_peromption, produits.quantite,
                            prix_ppa,prix_net,prix_tr, sum(sorties.quantite) consommation, date_sortie'))
                            ->orderby('designation')
                            ->join('sorties','id_produit','=','id')
                            ->where('deleted',0)
                            ->whereRaw('month(date_sortie) ='.$maxMois[0]->month.'')
                            ->whereRaw('year(date_sortie) ='.$maxMois[0]->year.'')
                            ->groupby('id')
                            ->get();
            foreach ($produits as $produit) {
                DB::table('produits')->where('id',$produit->id)
                                    ->update([
                                        'quantite' => $produit->quantite - $produit->consommation
                                    ]);
            }
            $newMois = true;
            
        }
        $data=[];
        $data  = [ 
            'date_sortie'=> $request->dateSortie,
            'num_ordonnance' => $request->ordonnance,
            'id_produit' => $request->produit,
            'quantite' => $request->quantite,
            'destination' => $request->destination
        ];
        $exists = sortie::where('id_produit',$request->produit)
                        ->where('num_ordonnance', $request->ordonnance)
                        ->where('date_sortie',$request->dateSortie);
        if($exists->exists()){
            $exists->update([
                'quantite' => $request->quantite,
                'destination' => $request->destination
            ]);
        }else{
            sortie::insert($data);
        }
        
        if($newMois){
            return [
                'code'=>1,
            ];
        }else {
            return ['code' => 0];
        }
    }


    public function updateSortie(Request $request){
        $sortie = DB::table('sorties')->where('date_sortie',$request->dateSortie)
                                    ->where('id_produit',$request->produitID)
                                    ->where('num_ordonnance',$request->ordonnance)
                                    ->update([
                                        'quantite' => $request->quantite,
                                        'destination' => $request->destination
                                    ]);
    }
    
    public function deleteSortie(Request $request){
        $sortie = sortie::where('date_sortie',$request->dateSortie)
                ->where('id_produit',$request->produitID)
                ->where('num_ordonnance',$request->ordonnance)
                ->delete();
    }

    public function getResteProduit(Request $request){
        $quantite = DB::table('produits')->select(DB::raw('produits.quantite stock, sum(sorties.quantite) conso'))
                                        ->join('sorties','id_produit','=','id')
                                        ->where('id',$request->id)
                                        ->get();
        if(sizeOf($quantite) > 0){
            return $quantite[0]->stock - $quantite[0]->conso;
        }
    }

    public function getTotalDestination(Request $request){
        $sorties = sortie::where('date_sortie',$request->dateSortie)
                                ->select(DB::raw('destination, id_produit, prix_tr, sorties.quantite ') )
                                ->join('produits','id','=','id_produit')
                                ->get();

        $destinations = DB::table('sorties')->where('date_sortie',$request->dateSortie)
                                    ->groupby('destination')
                                    ->get();
        
        $tabReturn = [];
        foreach ($destinations as $destination) {
            $tabReturn[] = [
                'destination' => $destination->destination,
                'total_tr' => 0
            ];
        }
        Debugbar::info($tabReturn);
        
        for ($j=0; $j < sizeOf($tabReturn); $j++) {
            for ($i=0; $i < sizeOf($sorties); $i++) { 
                if($sorties[$i]->destination == $tabReturn[$j]['destination']){
                    $tabReturn[$j]['total_tr'] = $tabReturn[$j]['total_tr'] + $sorties[$i]->quantite  * $sorties[$i]->prix_tr ;
                }
            }
        }
        Debugbar::info($tabReturn);
        return $tabReturn;
    }
}
