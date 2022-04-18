<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategoryList()
    {
        return Category::with('subCategories')->where('parent_id', 0)->get();
    }
}
