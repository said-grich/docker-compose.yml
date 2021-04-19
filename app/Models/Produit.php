<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    public $table="produits";
    protected $guarded =[];
    protected $casts = [
        'photos' => 'array',
    ];

    public function preparations(){

        return $this->hasMany(PreparationType::class);
    }

    public function tranches(){

        return $this->hasMany(ProduitTranche::class,'produit_id','id');
    }

    public function lots(){

        return $this->hasMany(Lot::class);
    }

    public function photos()
    {
        return $this->hasMany(ProduitPhoto::class);
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

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }

    public function prices()
    {
        return $this->hasMany(ProduitPrix::class);
    }

}
