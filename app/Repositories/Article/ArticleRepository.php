<?php

namespace App\Repositories\Article;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function createArticle($options)
    {
        return Auth::user()->articles()->create($options);
    }

    public function getArticle($id)
    {
        return Article::findOrFail($id);
    }

    public function getArticleBySlug($slug)
    {
        $article = Article::with(['author'])->where('slug', $slug)->first();

        if (!$article) {
            abort(404);
        }

        return $article;
    }

    public function getSuggestArticles($ignoreId = 0)
    {
        return Article::where('id', '!=', $ignoreId)
            ->inRandomOrder()
            ->limit(config('custom.suggest_num'))
            ->get();
    }

    public function getRecentArticles()
    {
        return Article::orderBy('published_at', 'desc')
            ->limit(config('custom.recent_num'))
            ->get();
    }
}
