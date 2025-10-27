<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsurancePayment extends Model
{

    protected $table = 'insurance_payments';
    protected $dates = ['contract_date','expiration_date'];
    protected $gaurd='id';
    protected $fillable = ['vehicle_id','contract_date','expiration_date','amount'];
    public function vehicle() { return $this->belongsTo(Vehicle::class); }
}
