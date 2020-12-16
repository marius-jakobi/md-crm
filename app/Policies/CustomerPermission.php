<?php

namespace App\Policies;

abstract class CustomerPermission {
    public const INDEX = 'index-customer';
    public const VIEW = 'view-customer';
    public const CREATE = 'create-customer';
    public const UPDATE = 'update-customer';
    public const DELETE = 'delete-customer';
}
