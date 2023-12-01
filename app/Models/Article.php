<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const IS_HOME = 1;
    const IS_NOT_HOME = 0;


    protected $appends = [
        'cat_slug'
    ];

    protected $guarded = ['id'];

    protected $table = 'news';

    public function category()
    {
        return $this->belongsTo(ArticlesCategories::class, 'category_id', 'id');
    }

    public function getCatSlugAttribute()
    {
        $cat = $this->category;
        if ($cat) {
            return $cat->alias;
        } else {
            return null;
        }
    }
}
