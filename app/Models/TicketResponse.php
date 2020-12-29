<?php

namespace App\Models;

use App\Interfaces\HasValidationRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketResponse extends Model implements HasValidationRules
{
    use HasFactory;

    protected $fillable = ['text'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    public static function validationRules() : array
    {
        return [
            'text' => 'required|string|min:3|max:2000',
        ];
    }
}
