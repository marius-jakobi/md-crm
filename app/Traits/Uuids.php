<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait Uuids {
    /**
     * boot function from Laravel
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $keyName = $model->getKeyName();
            if (empty($model->$keyName)) {
                $model->$keyName = Uuid::uuid4()->toString();
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
