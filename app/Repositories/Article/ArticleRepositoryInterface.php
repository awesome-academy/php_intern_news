<?php

namespace App\Repositories\Article;

interface ArticleRepositoryInterface
{
    public function createArticle($options);

    public function getArticle($id);
}
