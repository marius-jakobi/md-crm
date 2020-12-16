<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends CustomerAddress
{
    use HasFactory;

    protected $table = 'shipping_addresses';

    protected $fillable = ['name', 'street', 'zip', 'city'];
}
