<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VilleQuartier extends Model
{
    use HasFactory;

    public function zone(){

        return $this->belongsTo(VilleZone::class,'ville_zone_id','id');
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
