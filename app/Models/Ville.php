<?php

namespace App\Models;

use App\Http\Livewire\Parametrage\Depots;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    public function depots(){

        return $this->hasMany(Depot::class);
    }

    public function zones(){

        return $this->hasMany(VilleZone::class);
    }

    public function livreurs(){

        return $this->hasMany(Livreur::class);
    }
}
