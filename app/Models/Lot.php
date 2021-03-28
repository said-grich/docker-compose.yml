<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function qualite()
    {
        return $this->belongsTo(Qualite::class);
    }

    public function stockPoidPC()
    {
        return $this->hasMany(StockPoidsPc::class, 'lot_num', 'lot_num');
    }


}
