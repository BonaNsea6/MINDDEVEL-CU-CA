<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetPercevoirCommune extends Model
{
    use HasFactory;
    protected $fillable = [
        'annee',
        'userId',
        'partFixe',
        'partVariable',
        'total',
        'etat',
        'tauxRepartition',
        'totauxCommunes',
        'totalTrimestriel',  
        'recetteParCommune', 
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
