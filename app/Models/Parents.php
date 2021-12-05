<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'occupation',
        'email',
        'phoneNumber1',
        'phoneNumber2',
        'houseAddress',
        'workAddress',
        'schoolName'
    ];

     /**
     * Get the parent / guardian that has student.
     */
    
    public function student()
    {
        return $this->hasMany(Student::class, 'parentId');
    }

     /**
     * Get the parent in a session.
     */

     public function session()
     {
         return $this->belongsTo(Session::class, 'sessionId');
     }
}
