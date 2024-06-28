<?php

namespace Modules\Order\Enums;

enum PaymentStatus
{
    //
    const PENDING = 'pending';
    const PAID = 'paid';
    const PARTIALLY_REFUNDED = 'partially refunded';
    const Unpaid = 'unpaid';

    public static function getValues(): array
    {
        return [
            self::PENDING,
            self::PAID,
            self::PARTIALLY_REFUNDED,
            self::Unpaid

        ];
    }
}
