<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetteCommune extends Model
{

    use HasFactory;
    protected $fillable = [
        'annee',
        'userId',
        'pil',
        'ptc',
        'peds',
        'etat',
        'totalAnneeN2',
        'totalAnneeN3',
        'difference',
        'illigibilite',
        'tauxRepartition',
        'totauxCommunes',

    ];
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}