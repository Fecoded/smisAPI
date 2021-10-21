<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

     /**
     * Get the Class that has many Students.
     */
    
    public function student()
    {
        return $this->hasMany(Student::class, 'classId');
    }
     /**
     * Get the Class that has many Teachers.
     */
    
    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'classes_staff', 'classId', 'staffId');
    }
}
