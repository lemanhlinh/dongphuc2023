<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['created_time', 'edited_time'];

    const CREATED_AT = 'created_time';
    const UPDATED_AT = 'edited_time';

    protected $table = 'contact';
}
