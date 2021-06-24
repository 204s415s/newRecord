<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>生徒一覧</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('/css/sample.css') }}" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <h1>生徒一覧</h1>
        
        @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                            <p><a href="{{ url('/home') }}">{{ $login->name }}</a>'s top page</p>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
        @endif
        
        <table class="students" border="1" align="left" style="border-collapse: collapse">
            <tr>
                <th>期生</th>
                <th>氏名</th>
                <th>学年</th>
                <th>担当</th>
            </tr>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->class }}</a></td>
                <td><a href="/students/{{ $student->id }}">{{ $student->student_name }}</a></td>
                <td>{{ $student->grade }}</td>
                <td>{{ $student->user->name }}</td>
            </tr>
            @endforeach
            
        </table>
        
        <table class="progress" border="1" style="border-collapse: collapse">
            <tr>
                <th>最新進捗</th>
                <th>詳細</th>
            </tr>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->progress }}</td>
                    <td>{{ $result->question }}</td>
                </tr>
            @endforeach 
            
        </table>
        
        <a href="/">もどる</a>
        
      
       
    </body>
</html>
