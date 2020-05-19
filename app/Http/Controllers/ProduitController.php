<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\DB;
use App\Imports\ProduitsImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Produit;

class ProduitController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function importer(Request $request){
        DB::table('produits')->update([
            'deleted' => 1,
        ]);
        Excel::import(new ProduitsImport,request()->file('file'));
        return back();
    }
    public function getListeProduits(){
        $produits = produit::select(DB::raw('id, designation, date_peromption, produits.quantite,
                            prix_ppa,prix_net,prix_tr'))
                            ->orderby('designation')
                            ->where('deleted',0)
                            ->get();
        
        $maxMois = DB::table('sorties')->select(DB::raw('month(date_sortie) month, year(date_sortie) year, date_sortie'))
                            ->orderby('date_sortie','desc')
                            ->first();
        Debugbar::info($maxMois);
        $tab = [];

        $count = DB::table('sorties')->select(DB::raw('sum(quantite) consommation, id_produit'));
        if(isset($maxMois) ){
            $count = $count->whereRaw('month(date_sortie) ='.$maxMois->month.'')
                        ->whereRaw('year(date_sortie) ='.$maxMois->year.'')
                        ->groupby('id_produit');
        }
        $count = $count->get();

        foreach ($produits as $produit) {
            $a = 0;
            $trouve = false ;
            
            while ($a < sizeOf($count) && $trouve == false) {
                
                if( $produit->id == $count[$a]->id_produit ){
                    $trouve =true;
                    
                    $produit['consommation'] = $count[$a]->consommation;
                    
                }else{
                    $a++;
                }
            }
        }
        return $produits;
    }
    public function updateProduit(Request $request){ // entrées
        Produit::where('id',$request->id)
        ->update([
            'designation' => $request->designation,
            'date_peromption' => $request->datePeromption,
            'quantite' => $request->quantite,
            'prix_net' => $request->prixNet,
            'prix_ppa' => $request->prixPpa,
            'prix_tr' => $request->prixTr,
        ]);
    }
    public function addNewproduit(Request $request){
    // ajoute un nouveau produit au stock 
        $id = Produit::insertGetId([
            'designation' => $request->designation,
            'date_peromption' => $request->datePeromption,
            'quantite' => $request->quantite,
            'prix_net' => $request->prixNet,
            'prix_ppa' => $request->prixPpa,
            'prix_tr' => $request->prixTr,
        ]);    
        
        return $id;
    }

    public function deleteProduit(Request $request){
        Produit::where('id',$request->id)
                ->update([
                    'deleted' => 1,
                ]);
    }

    public function updateQuantite($id, $quantite){
        $quantiteInitiale = Produit::where('id',$id)->get()[0]['quantite'];
        $quantiteRes = $quantiteInitiale + $quantite;

        Produit::where('id',$id)
                ->update([
                    'quantite' => $quantiteRes
                ]);
    }
}