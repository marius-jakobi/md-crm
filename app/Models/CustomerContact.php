<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'mobile',
        'position',
        'division',
        'shipping_address_id',
    ];

    public static function validationRules()
    {
        return [
            'name' => 'required|between:3,255',
            'phone' => 'required|between:3,255',
            'email' => 'required|email|between:3,255',
        ];
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function shippingAddress() {
        return $this->belongsTo(ShippingAddress::class, 'shipping_address_id', 'id');
    }
}
