<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FullCitationCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'lecturer_id', 'year', 'num_of_citation'
    ];
}
