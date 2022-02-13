<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'name',
        'schoolName',
        'from',
        'to'
    ];

     public function parent()
     {
         return $this->hasMany(Parent::class, 'sessionId');
     }

     public function student()
     {
         return $this->hasMany(Student::class, 'sessionId');
     }

     public function staff()
     {
         return $this->hasMany(Staff::class, 'sessionId');
     }
     
     public function payment()
     {
         return $this->hasMany(Payment::class, 'sessionId');
     }
}
