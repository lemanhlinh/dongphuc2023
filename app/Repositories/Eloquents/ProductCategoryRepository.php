<?php

namespace App\Repositories\Eloquents;

use App\Models\ProductsCategories;
use App\Repositories\Contracts\ProductCategoryInterface;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\ProductsCategories';
    }

    public function updateTreeRebuild($root = null, $data)
    {
        return $this->model->rebuildSubtree(null, $data);
    }
}
