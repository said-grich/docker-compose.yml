<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function profil()
    {
        return $this->belongsTo(ProfilClient::class, 'profil_client_id');
    }

    public function bonsLivraison()
    {
        return $this->hasMany(BonLivraison::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
