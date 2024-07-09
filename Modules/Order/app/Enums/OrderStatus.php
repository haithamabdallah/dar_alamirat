<?php

namespace Modules\Order\Enums;

enum OrderStatus
{
    //
    const PENDING = 'pending';
    const PROCESSING = 'processing';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancelled';
    public static function getValues(): array
    {
        return [
            self::PENDING,
            self::PROCESSING,
            self::COMPLETED,
            self::CANCELLED,
        ];
    }

    public static function getAll(): array
    {
        return [
            self::PENDING => [ 'ar' => 'قيد الانتظار', 'en' => 'Pending' , 'color' => 'warning'],
            self::PROCESSING => [ 'ar' => 'جاري المعالجة', 'en' => 'Processing' , 'color' => 'primary'],
            self::COMPLETED => [ 'ar' => 'مكتمل', 'en' => 'Completed' , 'color' => 'success'],
            self::CANCELLED => [ 'ar' => 'ملغي', 'en' => 'Cancelled' , 'color' => 'danger'],
        ];
    }
}
