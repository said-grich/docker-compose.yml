<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    public function sousCategories(){

        return $this->hasMany(SousCategorie::class);

    }

    public function stock(){

        return $this->hasMany(Stock::class);

    }

    public function prices()
    {
        return $this->hasMany(ProduitPrix::class);
    }

}
