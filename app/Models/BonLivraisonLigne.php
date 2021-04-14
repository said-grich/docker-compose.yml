<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraisonLigne extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* public function produit()
    {
        return $this->belongsTo(Produit::class);
    } */

    public function piece()
    {
        return $this->belongsTo(Stock::class,'piece_id','id');
    }
}
