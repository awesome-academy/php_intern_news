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
        $article = Article::publishing()->with(['author'])->where('slug', $slug)->first();

        if (!$article) {
            abort(404);
        }

        return $article;
    }

    public function getSuggestArticles($ignoreId = 0)
    {
        return Article::publishing()->where('id', '!=', $ignoreId)
            ->inRandomOrder()
            ->limit(config('custom.suggest_num'))
            ->get();
    }

    public function getRecentArticles()
    {
        return Article::publishing()->orderBy('published_at', 'desc')
            ->limit(config('custom.recent_num'))
            ->get();
    }
    
    public function getArticleListAdmin()
    {
        return Article::where('published', '!=', config('custom.article_status.no_publish'))
            ->orderBy('published')->paginate(config('custom.per-page'));
    }

    public function getArticleAdmin($id)
    {
        $article = Article::where('published', '!=', config('custom.article_status.no_publish'))
            ->where('id', $id)->first();
        if (!$article) {
            abort(404);
        }

        return $article;
    }

    public function getArticleListGuest()
    {
        return Article::publishing()->orderBy('published_at', 'desc')->paginate(config('custom.per-page'));
    }
}
