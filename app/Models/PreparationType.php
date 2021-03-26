<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreparationType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function produit(){

        return $this->belongsTo(Produit::class);
    }

    public function preparation()
    {
        return $this->belongsTo(Preparation::class);
    }
}
