<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory, Uuids;

    private array $states = [
        TicketStatus::OPEN => 'offen',
        TicketStatus::IN_PROGRESS => 'in Bearbeitung',
        TicketStatus::DONE => 'erledigt'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class, 'shipping_address_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function creatorName()
    {
        return $this->creator->lastname . ', ' . $this->creator->firstname;
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function receiverName()
    {
        return $this->receiver->lastname . ', ' . $this->receiver->firstname;
    }

    public function statusText() {
        return $this->states[$this->status] ?? '---';
    }

    public function getStatusClass() {
        switch ($this->status) {
            case TicketStatus::OPEN:
                return 'warning';
            case TicketStatus::IN_PROGRESS:
                return 'info';
            case TicketStatus::DONE:
                return 'success';
            default:
                return 'secondary';
        }
    }
}
