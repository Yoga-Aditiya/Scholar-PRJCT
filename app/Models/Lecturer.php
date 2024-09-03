<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'front_title', 'back_title', 'scopus_id', 'scholar_id'
    ];

    public function userIdentity(){
        return $this->belongsTo(User::class);
    }
}
