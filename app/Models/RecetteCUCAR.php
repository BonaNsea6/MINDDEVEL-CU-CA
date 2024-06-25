<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetteCUCAR extends Model
{
    use HasFactory;
    protected $fillable = [
        'annee',
        'userId',
        'pic',
        'ptc',
        'pcac',
        'rdp',
        'rtps',
        'rdpc',
        'total',
        'resteCUB',
        'tauxApplique',
        'partFixe',
        'partVariable',
        'explication',
        'etat',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    
    }
}
