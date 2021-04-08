<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonLivraison extends Model
{
    use HasFactory;
    protected $guarded =  [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }
}
