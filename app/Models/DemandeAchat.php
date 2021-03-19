<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DemandeAchat extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
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
