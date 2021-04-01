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

    public function stockPoidsPiece(){

        return $this->hasMany(StockPoidsPc::class);

    }

    public function stockKgPiece(){

        return $this->hasMany(stockKgPiece::class);

    }
}
