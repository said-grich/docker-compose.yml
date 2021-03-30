<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonReception extends Model
{
    use HasFactory;

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function bonReceptionLignes()
    {
        return $this->hasMany(BonReceptionLigne::class);
    }
}
