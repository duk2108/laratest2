<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Test</title>
    <link rel="stylesheet" href="./main.css">
</head>
<body>
<div class="wrapper">
    <main class="main-content222">
        @if ($message = session('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
            <h2 class="heading">{{  __('site.articles') }}</h2>
            @foreach ($articles as $article)
            <div class="profile22">
                <h2>{{ $article['text'] }} </h2> <a href="{{ route('article.delete', $article['id']) }}">{{  Config::get('constants.delete') }} и {{  __('site.delete') }}</a><br><br>
                @foreach ($article['users'] as $user)
                    {{ $user['name'] }} <br>
                @endforeach
            </div>
            @endforeach
    </main>
</div>
</body>
</html>
