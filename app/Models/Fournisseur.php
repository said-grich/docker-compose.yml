<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function modePaiement(){

        return $this->belongsTo(ModePaiement::class, 'mode_paiement_id', 'id');
    }

    public function contacts(){

        return $this->hasMany(FournisseurContact::class);
    }

}
