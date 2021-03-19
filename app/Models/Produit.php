<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public static function search($word)
    {
        return empty($word) ? static::query()
            : static::where('num_lot', 'like', '%'.$word.'%')
            ;
    }
}
