<?php

namespace App\Policies;

abstract class ShippingAddressPermission {
    public const INDEX = 'index-shipping-address';
    public const VIEW = 'view-shipping-address';
    public const CREATE = 'create-shipping-address';
    public const UPDATE = 'update-shipping-address';
    public const DELETE = 'delete-shipping-address';
}
