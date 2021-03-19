<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonCommandeLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(BonCommande::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function bonCommande()
    {
        return $this->belongsTo(BonCommande::class, 'bon_commande_ref', 'ref');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

}

