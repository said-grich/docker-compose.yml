<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BonAchat extends Model
{
    use HasFactory;

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function commercial()
    {
        return $this->belongsTo(Commerciale::class);
    }
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function user()
    {
        return $this->belongsTo(Auth::user());
    }

    public static function search($word)
    {
        return empty($word) ? static::query()
            : static::where('ref', 'like', '%'.$word.'%')
                ->orWhere('date', 'like', '%'.$word.'%');
    }
}
