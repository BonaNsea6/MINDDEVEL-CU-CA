<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichierComptes extends Model
{
    use HasFactory;
    protected $fillable = [
        'annee',
        'pdf_file',
        'excel_file',
        'userId',
    ];
}
