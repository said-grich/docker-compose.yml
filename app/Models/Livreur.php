<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
