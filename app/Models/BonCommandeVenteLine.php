<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonCommandeVenteLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(DemandeAchat::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function bonCommandeVente()
    {
        return $this->belongsTo(bonCommandeVente::class, 'bon_commande_ref', 'ref');
    }
}
