<?php

namespace Modules\Order\Enums;

enum PaymentStatus
{
    //
    const PENDING = 'pending';
    const PAID = 'paid';
    const PARTIALLY_REFUNDED = 'partially refunded';

    public static function getValues(): array
    {
        return [
            self::PENDING,
            self::PAID,
            self::PARTIALLY_REFUNDED,

        ];
    }
}
