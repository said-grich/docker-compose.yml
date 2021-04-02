<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockKgPc extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tranche()
    {
        return $this->belongsTo(TranchesKgPc::class, 'tranche_id', 'uid');
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

    public function bonReception()
    {
        return $this->belongsTo(BonReception::class);
    }
}
