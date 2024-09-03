<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyAdmin extends Model
{
    protected $fillable = [
        'id', 'admin_id', 'faculty_id'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'admin_id','id');
    }
}
