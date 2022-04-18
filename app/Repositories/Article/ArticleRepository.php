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
}
