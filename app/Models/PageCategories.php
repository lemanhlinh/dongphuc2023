<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCategories extends Model
{
//    use HasFactory;
protected $guarded = ['id'];
    protected $table = 'contents_categories';
}
