<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $casts = [
        'photos' => 'array',
    ];

    public function preparations(){

        return $this->hasMany(PreparationType::class);
    }

    public function tranches(){

        return $this->hasMany(ProduitTranche::class);
    }

    public function lots(){

        return $this->hasMany(Lot::class);
    }

    public function photos()
    {
        return $this->hasMany(ProduitPhoto::class);
    }

    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class);
    }

    public function famille()
    {
        return $this->belongsTo(Famille::class);
    }

    public function modeVente()
    {
        return $this->belongsTo(ModeVente::class);
    }

    public function modePreparation()
    {
        return $this->belongsTo(ModePreparation::class);
    }

    public function stockPoidsPiece()
    {
        return $this->belongsTo(StockPoidsPc::class);
    }

    public function stockKgsPiece()
    {
        return $this->belongsTo(StockKgsPc::class);
    }
}
