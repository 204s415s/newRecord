<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>トップページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    
    <body>
        
        @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        
                            <p><a href="{{ url('/home') }}">{{ $user->name }}</a>'s top page</p>
                        
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        
        <div class="record">    
            <h2>進捗記録</h2>
                <p class="curriculum"><a href="/curricula/record">カリキュラム</a></p>
                <p class="project"><a href="/projects/record">成果物</a></p>
        </div>
        
        <div class="student">
            <p><a href="/students/create">生徒登録</a> / <a href="/students/index">生徒一覧</a></p>
        </div>
        
    </body>
</html>