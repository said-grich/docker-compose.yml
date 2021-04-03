<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPoidsPc extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tranche()
    {
        return $this->belongsTo(TranchesPoidsPc::class, 'tranche_id', 'uid');
    }

    public function lot()
    {
        return $this->belongsTo(Lot::class, 'lot_num', 'lot_num');
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function qualite()
    {
        return $this->belongsTo(Qualite::class);
    }

    public function bonReception()
    {
        return $this->belongsTo(BonReception::class);
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }

}
