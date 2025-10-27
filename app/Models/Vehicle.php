<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $gaurd = 'id';
    protected $fillable = ['name', 'plate_number', 'imei', 'vin', 'year', 'license'];

    public function fuelEntries()
    {
        return $this->hasMany(FuelEntry::class);
    }

    public function insurancePayments()
    {
        return $this->hasMany(InsurancePayment::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
