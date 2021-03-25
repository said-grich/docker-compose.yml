<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FournisseurContact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fournisseur(){

        return $this->belongsTo(Fournisseur::class);
    }
}
