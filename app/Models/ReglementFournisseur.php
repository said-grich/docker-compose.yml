<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReglementFournisseur extends Model
{
    use HasFactory;

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function modePaiement()
    {
        return $this->belongsTo(ModePaiement::class, 'mode_paiement_id', 'id');
    }

    public function compteDebiteur()
    {
        return $this->belongsTo(Compte::class, 'compte_debiteur_id');
    }

    public function compteCrediteur()
    {
        return $this->belongsTo(Compte::class, 'compte_crediteur_id');
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }

}
