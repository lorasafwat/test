<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable=[
        'MRN',
        'fname',
        'lname',
        'password',
        'protocol',
        'medical_history',
        'age',
        'receptionist_id',
        'token'
    ];
}
