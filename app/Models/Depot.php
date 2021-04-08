<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    public function zone()
    {
        return $this->belongsTo(VilleZone::class);
    }

    public function stockPoidPC()
    {
        return $this->hasMany(StockPoidsPc::class);
    }

    public function stockKgPC()
    {
        return $this->hasMany(StockKgPc::class);
    }

    public function bonsReception()
    {
        return $this->hasMany(BonReception::class);
    }

    public function bonsLivraison()
    {
        return $this->hasMany(BonLivraison::class);
    }

}
