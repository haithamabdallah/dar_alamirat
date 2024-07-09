<?php

namespace Modules\Order\Enums;

enum PaymentStatus
{
    //
    const PENDING = 'pending';
    const PAID = 'paid';
    const PARTIALLY_REFUNDED = 'partially refunded';
    const CANCELLED = 'cancelled';

    public static function getValues(): array
    {
        return [
            self::PENDING,
            self::PAID,
            self::PARTIALLY_REFUNDED,
            self::CANCELLED

        ];
    }

    public static function getAll(): array
    {
        return [
            self::PENDING => [ 'ar' => 'قيد الانتظار', 'en' => 'Pending' , 'color' => 'warning'],
            self::PAID => [ 'ar' => 'مدفوع', 'en' => 'Paid' , 'color' => 'success'],
            self::PARTIALLY_REFUNDED => [ 'ar' => 'مسترجع جزئيا', 'en' => 'Partially Refunded' , 'color' => 'primary'],
            self::CANCELLED => [ 'ar' => 'ملغي', 'en' => 'Cancelled' , 'color' => 'danger'],
        ];
    }
}
