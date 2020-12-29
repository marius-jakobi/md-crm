<?php

namespace App\Policies;

abstract class TicketResponsePermission {
    public const INDEX = 'index-ticket-response';
    public const VIEW = 'view-ticket-response';
    public const CREATE = 'create-ticket-response';
    public const UPDATE = 'update-ticket-response';
    public const DELETE = 'delete-ticket-response';
}
