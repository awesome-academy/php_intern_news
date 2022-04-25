<?php

namespace App\Repositories\Article;

interface ArticleRepositoryInterface
{
    public function createArticle($options);

    public function getArticle($id);

    public function getArticleBySlug($slug);

    public function getSuggestArticles($ignoreId);

    public function getRecentArticles();

    public function getArticleListAdmin();

    public function getArticleAdmin($id);
}
