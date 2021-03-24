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
}
