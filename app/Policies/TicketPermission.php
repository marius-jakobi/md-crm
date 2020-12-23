<?php

namespace App\Policies;

abstract class TicketPermission {
    public const INDEX = 'index-ticket';
    public const VIEW = 'view-ticket';
    public const CREATE = 'create-ticket';
    public const UPDATE = 'update-ticket';
    public const DELETE = 'delete-ticket';
}
