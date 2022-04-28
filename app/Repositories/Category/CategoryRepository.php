<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategoryList()
    {
        return Category::with('subCategories')->where('parent_id', 0)->get();
    }

    public function getCategory($id)
    {
        return Category::findOrFail($id);
    }

    public function creatCategory($options)
    {
        return Category::create($options);
    }

    public function getCategoryBySlug($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            abort(404);
        }

        return $category;
    }

    public function getAllCategories()
    {
        return Category::with('category')->get();
    }
}
