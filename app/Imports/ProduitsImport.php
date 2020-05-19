<?php

namespace App\Imports;

use App\produit;
use Maatwebsite\Excel\Concerns\ToModel;
use Log;
use Carbon\Carbon;
class ProduitsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        return new produit([
            'designation' => $row[0],
            'date_peromption' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1])),
            'quantite' => $row[2],
            'prix_ppa' => $row[3],
            'prix_tr' =>  $row[4],
            'prix_net' => $row[5],
        ]);
    }
}
