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
        'dateOfRegistration',
        'schoolName'
    ];

    public function staffNextOfKin() 
    {
        return $this->hasOne(StaffNextOfKin::class, 'staffId');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'sessionId');
    }

    public function classes() 
    {
        return $this->belongsToMany(Classes::class, 'classes_staff', 'classId', 'staffId');
    }

}
