<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = ['name', 'description', 'schoolName'];

    public function payment()
    {
        return $this->hasMany(Payment::class, 'paymentTypeId');
    }
}
