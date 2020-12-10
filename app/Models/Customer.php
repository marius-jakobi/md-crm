<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Uuids;

    public function billingAddresses() {
        return $this->hasMany(BillingAddress::class, 'customer_id', 'id');
    }

    public function shippingAddresses() {
        return $this->hasMany(BillingAddress::class, 'customer_id', 'id');
    }
}
