<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivreurCommande extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function livreur()
    {
        return $this->belongsTo(Livreur::class, 'livreur_id', 'id');
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id', 'id');
    }
}
