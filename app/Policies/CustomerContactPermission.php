<?php

namespace App\Policies;

abstract class CustomerContactPermission {
    public const INDEX = 'index-customer-contact';
    public const VIEW = 'view-customer-contact';
    public const CREATE = 'create-customer-contact';
    public const UPDATE = 'update-customer-contact';
    public const DELETE = 'delete-customer-contact';
}
