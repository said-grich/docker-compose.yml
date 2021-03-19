<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraisonLine extends Model
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

    public function bonLivraison()
    {
        return $this->belongsTo(BonLivraison::class, 'bon_livraison_ref', 'ref');
    }
}
