<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffNextOfKin extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'surname',
        'firstname',
        'middlename',
        'gender',
        'email',
        'phoneNumber1',
        'phoneNumber2',
        'address',
        'relationship'
    ];

     
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staffId');
    }
}
