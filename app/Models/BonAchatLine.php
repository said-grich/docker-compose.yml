<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonAchatLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(BonAchat::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function bonAchat()
    {
        return $this->belongsTo(BonAchat::class, 'bon_achat_ref', 'ref');
    }
}
