<?php

use Illuminate\Support\Facades\Auth;
use App\model\User;
use Barryvdh\Debugbar\Facade as Debugbar; 


Route::get('/', function () {
    return view('admin');
})->middleware('auth');

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth');

Auth::routes();



/////////////////////////////////////////////////   Produits 
Route::post('/importer','ProduitController@importer')->name('import');
Route::get('/getListeProduits','ProduitController@getListeProduits');
Route::post('/updateProduit','ProduitController@updateProduit');
Route::post('/addNewproduit','ProduitController@addNewproduit');
Route::post('/deleteProduit','ProduitController@deleteProduit');



////////////////////////////////////////////////    Entrées
Route::post('/listeEntree','EntreeController@listeEntree');
Route::get('/listeAllEntree','EntreeController@listeAllEntree');
Route::post('/newEntree','EntreeController@newEntree');
Route::post('/updateEntree','EntreeController@updateEntree');
Route::post('/deleteEntree','EntreeController@deleteEntree');


////////////////////////////////////////////////    Sorties
Route::post('/listeSorties','SortieController@listeSorties');
Route::post('/newSortie','SortieController@newSortie');
Route::post('/updateSortie','SortieController@updateSortie');
Route::post('/deleteSortie','SortieController@deleteSortie');
Route::post('/getResteProduit','SortieController@getResteProduit');
Route::post('/getTotalDestination','SortieController@getTotalDestination');


////////////////////////////////////////////////    Factures
Route::post('/addFacture','FacturerController@addFacture');
Route::post('/updateFacture','FacturerController@updateFacture');
Route::delete('/deleteFacture/{facture}','FacturerController@deleteFacture');
Route::get('/getListeFacture','FacturerController@getListeFacture');
Route::post('/getListeProduitFacture','FacturerController@getListeProduitFacture');


//////////////////////////////////////////////      Fournisseur 
Route::post('/addFournisseur','FournisseurController@addFournisseur');
Route::delete('/deleteFournisseur/{fournisseur}','FournisseurController@deleteFournisseur');
Route::get('/getListeFournisseur','FournisseurController@getListeFournisseur');

//////////////////////////////////////////////      Destination 
Route::post('/addDestination','DestinationController@addDestination');
Route::delete('/deleteDestination/{destination}','DestinationController@deleteDestination');
Route::get('/getListeDestination','DestinationController@getListeDestination');





$adminRoutes = ['/produits','/fournisseurs','/factures','/admin','/entreesortie/{date}'];

foreach ($adminRoutes as $route) {
    Route::get($route,function(){
        return view('admin');
    })->middleware('auth');
}