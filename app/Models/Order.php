<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
//    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'order';

    const STATUS_WAITING = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_CANCEL = 2;

    const STATUS = [
        self::STATUS_WAITING => 'Đợi xử lý',
        self::STATUS_SUCCESS => 'Hoàn thành',
        self::STATUS_CANCEL => 'Hủy'
    ];
}
