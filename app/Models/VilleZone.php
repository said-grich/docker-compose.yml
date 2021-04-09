<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VilleZone extends Model
{
    use HasFactory;

    public function ville(){

        return $this->belongsTo(Ville::class,'ville_id','id');
    }

    public function depots(){

        return $this->hasMany(Depot::class);
    }

    public function quatrier(){

        return $this->hasMany(VilleQuartier::class);
    }
}
