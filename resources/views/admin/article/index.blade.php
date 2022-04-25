<table>
    <thead>
        <th>{{ __('Title') }}</th>
        <th>{{ __('Categories') }}</th>
        <th>{{ __('Created at') }}</th>
        <th>{{ __('Author') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Options') }}</th>
    </thead>
    <tbody>
        @foreach ($articles as $article)
            <tr>
                <td><a href="{{ route('admin.articles.show', $article->id) }}">{{ $article->title }}</a></td>
                <td>{{ $article->getCategoriesString() }}</td>
                <td>{{ $article->created_at }}</td>
                <td>{{ $article->author->name }}</td>
                <td><span class="badge badge-{{ $article->publish_status['style'] }}">
                        {{ $article->publish_status['string'] }}
                    </span>
                </td>
                <td>
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
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
