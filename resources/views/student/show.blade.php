<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>生徒詳細</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <div class="student">
                <p class="name">{{ $student->student_name }}さん</p>
                <p class="grade">{{ $student->grade }}</p>
        </div>
        
        @foreach($results as $result)
            <p>{{ $result->section }}</p>
            <p>{{ $result->progress }}</p>
            <p>{{ $result->question }}</p>
            <p>{{ $result->created_at}}</p>
        @endforeach
        
        <div class="back">[ <a href="/students/index">back</a> ]</div>
        <script>
                function DeletePost() {
                    'use strict';
                    if (confirm('本当に削除しますか？')) {
                        document.getElementById('form_delete').submit();
                    }
                }
        </script>
    </body>
        