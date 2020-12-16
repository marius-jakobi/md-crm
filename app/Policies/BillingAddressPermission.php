<?php

namespace App\Policies;

abstract class BillingAddressPermission {
    public const INDEX = 'index-billing-address';
    public const VIEW = 'view-billing-address';
    public const CREATE = 'create-billing-address';
    public const UPDATE = 'update-billing-address';
    public const DELETE = 'delete-billing-address';
}
