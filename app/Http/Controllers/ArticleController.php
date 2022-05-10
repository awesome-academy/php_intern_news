<?php

namespace App\Http\Controllers;

use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleRepository;
    protected $categoryRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function show($slug)
    {
        $article = $this->articleRepository->getArticleBySlug($slug);
        $suggests = $this->articleRepository->getSuggestArticles($article->id);
        $recents = $this->articleRepository->getRecentArticles();

        return view('guest.article.show', compact('article', 'suggests', 'recents'));
    }

    public function search()
    {
        $query = request()->query('q');
        $articleList = $this->articleRepository->getArticleListGuest();
        
        return view('guest.article.search', compact('articleList', 'query'));
    }
}
