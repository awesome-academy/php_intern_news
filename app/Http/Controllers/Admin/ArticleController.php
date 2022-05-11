<?php

namespace App\Http\Controllers\Admin;

use App\Events\PublishNotificationEvent;
use App\Http\Controllers\Controller;
use App\Notifications\PublishNotification;
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

            $data = [
                'message' => __('The article :title has been :status', [
                    'title' => $article->title,
                    'status' => __(config('custom.article_status_text')[$article->published])
                ]),
                'created_at' => Carbon::now()->toDateTimeString(),
            ];

            $user = $article->author;

            $user->notify(new PublishNotification($data));
            $notification_id = $user->notifications->first()->id;
            $data['notification_id'] = $notification_id;

            event(new PublishNotificationEvent($data, $user->id));

            return back()->with('success', __('Changed successfully'));
        }

        return back()->with('error', __('Change failed'));
    }
}
