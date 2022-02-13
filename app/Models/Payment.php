<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'fullname',
        'class',
        'paidDate',
        'amount',
        'schoolName',
        'sessionId',
        'paymentTypeId',
    ];

     public function session()
     {
         return $this->belongsTo(Session::class, 'sessionId');
     }

     public function payment_type()
     {
         return $this->belongsTo(Payment::class, 'paymentTypeId');
     }

}
