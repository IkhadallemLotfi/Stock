<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produit extends Model
{
    protected $fillable = [
        'designation','quantite','prix_ppa','prix_tr','prix_net','date_peromption'
    ];
}
