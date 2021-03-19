<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BonCommande extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function user()
    {
        return $this->belongsTo(Auth::user());
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function refDemandeAchat()
    {
        return $this->belongsTo(DemandeAchat::class);
    }

    public static function search($word)
    {
        return empty($word) ? static::query()
            : static::where('ref', 'like', '%'.$word.'%')
                ->orWhere('date', 'like', '%'.$word.'%');
    }
}

