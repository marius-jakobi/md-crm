<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends CustomerAddress
{
    use HasFactory;

    protected $table = 'billing_addresses';

    protected $fillable = ['name', 'street', 'po_box', 'zip', 'city'];
}
