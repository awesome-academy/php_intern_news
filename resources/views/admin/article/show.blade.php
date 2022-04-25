<a
    href="{{ route('admin.articles.change-status', [
        'id' => $article->id,
        'status' => config('custom.article_status.approved'),
    ]) }}">{{ __('Approve') }}</a>
<a
    href="{{ route('admin.articles.change-status', [
        'id' => $article->id,
        'status' => config('custom.article_status.rejected'),
    ]) }}">{{ __('Reject') }}</a>
