<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'phone',
        'address',
        'dob',
    ];

     /**
     * Get the user that owns the profile.
     */
    
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
