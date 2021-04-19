<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function modePaiement()
    {
        return $this->belongsTo(ModePaiement::class);
    }

    public function modeLivraison()
    {
        return $this->belongsTo(ModeLivraison::class);
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }

    public function villeQuartier()
    {
        return $this->belongsTo(VilleQuartier::class,'ville_quartie_id','id');
    }


    public function commandeLignes()
    {
        return $this->hasMany(CommandeLigne::class,'commande_ref','ref');
    }

    public function geMontantTotal()
    {
        return $this->commandeLignes()->sum('montant');
    }

}
