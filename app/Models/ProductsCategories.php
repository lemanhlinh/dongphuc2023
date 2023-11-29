<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class ProductsCategories extends Model
{
    use NodeTrait;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const IS_HOME = 1;
    const IS_NOT_HOME = 0;

    protected $guarded = ['id', '_lft', '_rgt'];
    protected $table = 'products_categories';
//    public function products()
//    {
//        return $this->hasMany(Product::class,'category_id');
//    }

//    public function children()
//    {
//        return $this->hasMany(ProductsCategories::class, 'parent_id');
//    }
//
//    public function parent()
//    {
//        return $this->belongsTo(ProductsCategories::class, 'parent_id');
//    }
}
