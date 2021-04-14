<?php

namespace App\Models;

use App\Http\Livewire\Parametrage\Tranche;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeVente extends Model
{
    use HasFactory;

    /* public function tranches()
    {
        return $this->hasMany(Tranche::class);
    } */

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
