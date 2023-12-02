<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
//    use HasFactory;
protected $guarded = ['id'];
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const TYPE_IMAGE = 1;
    const TYPE_EDITOR = 3;

    const TYPE = [
        self::TYPE_IMAGE => 'Image',
        self::TYPE_EDITOR => 'Editor',
    ];
}
