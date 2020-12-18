<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends CustomerAddress
{
    use HasFactory;

    protected $table = 'billing_addresses';

    protected $fillable = ['name', 'street', 'po_box', 'zip', 'city'];

    public static function validationRules() : array {
        return [
            'name' => 'required|string|between:3,128',
            'street' => 'required_without:po_box',
            'po_box' => 'required_without:street',
            'zip' => 'required|regex:/[0-9]{5}/',
            'city' => 'required|string|between:3,128',
        ];
    }
}
