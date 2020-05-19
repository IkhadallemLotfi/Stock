<?php

namespace App\Exports;

use App\produit;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProduitExport implements FromCollection
{
    
    public function collection()
    {
        return produit::where('deleted',0)
                        ->get();
    }
}