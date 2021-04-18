<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraison extends Model
{
    use HasFactory;
    protected $guarded =  [];

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function bonLivraisonLignes()
    {
        return $this->hasMany(BonLivraisonLigne::class,'bon_livraison_ref','ref');
    }
    public function geMontantTotal()
    {
        return $this->bonLivraisonLignes()->sum('montant');
    }
}
