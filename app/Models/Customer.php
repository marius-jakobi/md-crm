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
        return $this->hasMany(ShippingAddress::class, 'customer_id', 'id');
    }

    public function customerContacts() {
        return $this->hasMany(CustomerContact::class, 'customer_id', 'id');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class, 'customer_id', 'id');
    }

    /**
     * Alias for customer contacts
     */
    public function contacts() {
        return $this->customerContacts();
    }
}
