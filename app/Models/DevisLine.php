<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(DemandeAchat::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function devis()
    {
        return $this->belongsTo(Devis::class, 'devis_ref', 'ref');
    }
}
