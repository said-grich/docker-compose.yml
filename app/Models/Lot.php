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

    public function stock()
    {
        return $this->hasMany(Stock::class, 'lot_num', 'lot_num');
    }

    public function bonReception()
    {
        return $this->belongsTo(StockKgPc::class, 'br_num', 'ref');
    }


}
