<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const IS_HOME = 1;
    const IS_NOT_HOME = 0;
    protected $table = 'contents';
    protected $guarded = ['id'];
}
