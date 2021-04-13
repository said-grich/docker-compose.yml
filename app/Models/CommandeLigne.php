<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeLigne extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'preparations_cuisine' => 'array',
        'preparations_nettoyage' => 'array',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    /* public function produit()
    {
        return $this->belongsTo(Produit::class);
    } */

    public function produit()
    {
        return $this->belongsTo(Stock::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
