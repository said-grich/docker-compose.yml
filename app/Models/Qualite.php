<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualite extends Model
{
    use HasFactory;

    public function lots(){
        return $this->hasMany(Lot::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'qualite_id', 'id');
    }

    public function bonsReception()
    {
        return $this->hasMany(BonReception::class);
    }
}
