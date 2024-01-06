<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const IS_HOME = 1;
    const IS_NOT_HOME = 0;

    protected $appends = [
        'slug_cat',
    ];

    protected $guarded = ['id'];

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(ProductsCategories::class, 'category_id','id');
    }

    public function productOption()
    {
        return $this->hasMany(ProductOptions::class, 'parent_id', 'id');
    }

    public function productsImages()
    {
        return $this->hasMany(ProductsImages::class, 'record_id', 'id');
    }

    public function getSlugCatAttribute()
    {
        $slug_cat = $this->category->alias;
        return $slug_cat;
    }
}
