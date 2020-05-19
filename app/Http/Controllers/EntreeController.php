<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\entree;
use Config;
use Log;
class EntreeController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function listeEntree(Request $request){
        Debugbar::info($request->dateEntree);
        return entree::select(DB::raw('id, designation, date_peromption, date_entree, prix_ppa, prix_tr,
                    prix_net, entrees.quantite, produits.quantite stock ,num_facture,fournisseur') )

                    ->where('date_entree',$request->dateEntree)
                    ->join('factures','num_facture','=','numero')
                    ->join('produits','id_produit','=','id')
                    ->get();
    }
    public function listeAllEntree(){
        return entree::get();
    }
    public function newEntree(Request $request){
    // met à jour la quantité d'un produit déjà existant et l'enregistre aux entrées
        $data=[];
        $ctrlProduit = new ProduitController();
        $exists = DB::table('produits')->where('designation',$request->designation)
                                    ->where('prix_ppa',$request->prixPpa)
                                    ->where('prix_net',$request->prixNet)
                                    ->where('prix_tr',$request->prixTr)
                                    ->where('date_peromption',$request->datePeromption)
                                    ->where('deleted',0)
                                    ->get();
        if( sizeOf($exists) > 0 ){ // si l'ID du produit est existant
            $produit = $exists[0]->id;
            $ctrlProduit->updateQuantite($produit, $request->quantite);
        }else{
            $produit = $ctrlProduit->addNewproduit($request);
        }
        
        $data  = [
            'date_entree'=> $request->dateEntree,
            'num_facture' => $request->facture,
            'id_produit' => $produit,
            'quantite' => $request->quantite,
        ];
        entree::insert($data);
    }


    public function updateEntree(Request $request){
        $entree = DB::table('entrees')->where('date_entree',$request->dateEntree)
                ->where('id_produit',$request->produitID)
                ->where('num_facture',$request->facture);
        
        $quantiteInitial = $entree->get()[0]->quantite;
        $entree->update([
                'quantite' => $request->quantite,
            ]);

        $quantiteToUpdate = $request->quantite - $quantiteInitial; 
        $ctrlProduit = new ProduitController();
        $ctrlProduit->updateQuantite($request->produitID, $quantiteToUpdate);
    }



    public function deleteEntree(Request $request){
        $entree = entree::where('date_entree',$request->dateEntree)
                ->where('id_produit',$request->produitID)
                ->where('num_facture',$request->facture);
        
        $quantite = 0 - $entree->get()[0]['quantite'];
        $entree->delete();

        $ctrlProduit = new ProduitController();
        $ctrlProduit->updateQuantite($request->produitID, $quantite); // on envoie une quantité négative
    }
}
