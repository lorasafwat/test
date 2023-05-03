<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model implements JWTSubject
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'id' => $this->id,
            'MRN' => $this->MRN,
            'fname' => $this->fname,
            'lname' => $this->lname,
            'protocol'=>$this->protocol,
            'age'=>$this->age,
        ];
    }

}
