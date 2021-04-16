<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranche extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function stock()
    {
        return $this->hasMany(Stock::class, 'tranche_id', 'uid');
    }

    public function modevente()
    {
        return $this->belongsTo(ModeVente::class);
    }

    public function produitTranche(){
        return $this->hasMany(ProduitTranche::class);
    }
}
