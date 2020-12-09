<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['identifier', 'description'];
    public $timestamps = false;

    public function setIdentifierAttribute($value)
    {
        $this->attributes['identifier'] = str_replace(' ', '-', strtolower($value));
    }
}
