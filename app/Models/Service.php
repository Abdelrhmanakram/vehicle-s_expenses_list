<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $dates = ['start_date', 'end_date', 'created_at', 'updated_at'];
    protected $gaurd = 'id';
    protected $fillable = ['vehicle_id', 'start_date', 'end_date', 'invoice_number', 'purchase_order_number', 'status', 'discount', 'tax', 'total'];
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
