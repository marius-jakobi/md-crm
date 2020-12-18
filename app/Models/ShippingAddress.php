<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends CustomerAddress
{
    use HasFactory;

    protected $table = 'shipping_addresses';

    protected $fillable = ['name', 'street', 'zip', 'city'];

    public static function validationRules() : array {
        return [
            'name' => 'required|string|between:3,128',
            'street' => 'required_without:po_box',
            'zip' => 'required|regex:/[0-9]{5}/',
            'city' => 'required|string|between:3,128',
        ];
    }
}
