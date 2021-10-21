<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
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
        'emergencyContact',
        'classAdmitted',
        'dateOfRegistration'
    ];

     /**
     * Get the student that owns the parent.
     */
    
    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parentId');
    }

    public function classes() 
    {
        return $this->belongsTo(Classes::class, 'classId');
    }


}
