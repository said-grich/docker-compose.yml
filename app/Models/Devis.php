<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Devis extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(Auth::user());
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public static function search($word)
    {
        return empty($word) ? static::query()
            : static::where('ref', 'like', '%'.$word.'%')
                ->orWhere('date', 'like', '%'.$word.'%');
    }
}
