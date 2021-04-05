<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    use HasFactory;

    public function stockPoidsPc()
    {
        return $this->hasMany(StockPoidsPc::class);
    }

    public function stockKgPc()
    {
        return $this->hasMany(StockKgPc::class);
    }

    public function produit()
    {
        return $this->hasMany(Produit::class);
    }
}
