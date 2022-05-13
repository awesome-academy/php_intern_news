<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>

<body>
    <h1 style="color: rgb(54, 91, 212)">{{ __('Weekly Report Email') }}</h1>
    <p style="color: gray">{{ __('Hi') }} <strong style="color:orangered"> {{ $user->name }}</strong>!</p>
    <p style="color: gray">
        {{ __("There're :number pending articles, check them out", ['number' => $articles->count()]) }}:</p>

    <table border="1" style="border-collapse: collapse" cellpadding="5px">
        <thead>
            <th colspan="2" style="color: gray">{{ __('Title') }}</th>
            <th style="color: gray">{{ __('Author') }}</th>
            <th style="color: gray">{{ __('Requested at') }}</th>
        </thead>
        <tbody>
            @foreach ($articles as $index => $article)
                <tr>
                    <td style="color: gray">{{ $index + 1 }}</td>
                    <td style="color: gray">
                        <a href="{{ route('admin.articles.show', $article->id) }}" target="_blank"
                            style="text-decoration: none; color:gray; cursor: pointer">
                            {{ $article->title }}
                        </a>
                    </td>
                    <td style="color: gray">{{ $article->author->name }}</td>
                    <td style="color: gray">{{ $article->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="color: gray">{{ __('From :name', ['name' => config('app.name')]) }}</p>
</body>

</html>
