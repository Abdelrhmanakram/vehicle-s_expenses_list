<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelEntry extends Model
{
      protected $table = 'fuel_entries';

    protected $dates = ['entry_date'];

    protected $gaurd='id';
    
    protected $fillable = ['vehicle_id','entry_date','volume','cost'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
