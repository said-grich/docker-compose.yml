<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitPrix extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tranche()
    {
        return $this->belongsTo(Tranche::class, 'tranche_id', 'uid');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id', 'id');
    }

}
