<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Article\ArticleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->getArticleListAdmin();

        return view('admin.article.index', compact('articles'));
    }

    public function show($id)
    {
        $article = $this->articleRepository->getArticleAdmin($id);

        return view('admin.article.show', compact('article'));
    }

    public function changeStatus($id, $status)
    {
        $article = $this->articleRepository->getArticleAdmin($id);

        if ($status > config('custom.article_status.pending')
            &&
            $status <= config('custom.article_status.rejected')
        ) {
            $article->published = $status;
            if ($status == config('custom.article_status.approved')) {
                $article->published_at = Carbon::now()->toDateTimeString();
            }

            $article->approved_by = Auth::user()->id;
            $article->save();

            return back()->with('success', __('Changed successfully'));
        }

        return back()->with('error', __('Change failed'));
    }
}
