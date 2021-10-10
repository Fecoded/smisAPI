<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'surname',
        'firstname',
        'middlename',
        'gender',
        'dob',
        'houseAddress',
        'placeOfBirth',
        'religion',
        'nationality',
        'stateOfOrigin',
        'dateOfEmployment',
        'dateOfRegistration'
    ];

    public function staffNextOfKin() 
    {
        return $this->hasOne(StaffNextOfKin::class, 'staffId');
    }


}
