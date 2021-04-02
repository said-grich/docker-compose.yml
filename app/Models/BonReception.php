<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonReception extends Model
{
    use HasFactory;

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function qualite()
    {
        return $this->belongsTo(Qualite::class);
    }

    /* public function stockPoidsPc()
    {
        return $this->belongsTo(StockPoidsPc::class,'br_num','ref');
    } */

    public function stockPoidsPc()
    {
        return $this->hasMany(StockPoidsPc::class,'br_num','ref');
    }

    public function bonReceptionLignes()
    {
        return $this->hasMany(BonReceptionLigne::class,'bon_reception_ref','ref');
    }
    public function geMontantTotal()
    {
        return $this->bonReceptionLignes()->sum('montant');
    }
}
