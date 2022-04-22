<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function getCategoryList();

    public function getCategory($id);

    public function creatCategory($options);

    public function getCategoryBySlug($slug);

    public function getAllCategories();
}
