<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CubCar extends Model
{
    use HasFactory;
    protected $fillable = [
        'cubId',
        'carId',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    
    }

    public function cubUser()
    {
        return $this->belongsTo(User::class, 'cubId'); // Relation de cubUser avec User (cubId comme clé étrangère)
    }

    public function carUser()
    {
        return $this->belongsTo(User::class, 'carId'); // Relation de carUser avec User (carId comme clé étrangère)
    }
}
