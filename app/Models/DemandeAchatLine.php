<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeAchatLine extends Model
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
    public function demandeAchat()
    {
        return $this->belongsTo(DemandeAchat::class, 'demande_achat_ref', 'ref');
    }
}
