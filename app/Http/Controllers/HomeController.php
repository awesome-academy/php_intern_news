<?php

namespace App\Http\Controllers;

use App\Repositories\Article\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $articleRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articleList = $this->articleRepository->getArticleListGuest();

        return view('guest.index', compact('articleList'));
    }
}
