<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\destination;

class DestinationController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); 
    }

    public function getListeDestination(){
        return destination::get();
    }
    public function deleteDestination(Request $request){
        destination::where('destination',$request->destination)
                    ->delete();
    }

    public function addDestination(Request $request){
        $exists = destination::where('destination', $request->destination)
                    ->exists();
        if(!$exists){
            destination::insert([
                'destination' => $request->destination,
                'created_at' => Carbon::now()
            ]);
        }
    }
}
