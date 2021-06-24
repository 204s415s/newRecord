<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>生徒登録</title>
    </head>
    
    <body>
        <h1>生徒情報登録</h1>
            <form action="/students", method="POST", enctype="multipart/form-data" >
                @csrf
                <div class="name">
                    <p>氏名<input type="text" name="student[student_name]" /></p>
                </div>
                <div class="class">
                    <p><input type="text" name="student[class]">期生</p>
                </div>
                <div class="grade">
                    <p>学年：
                        <select name="student[grade]">
                            @foreach(config('grade') as $key => $grade)
                              <option value="{{ $grade }}">{{ $grade }}</option>
                            @endforeach
                        </select>
                    </p>
                </div> 
                <div class="experience">
                    <p>プログラミング経験：
                        <select name="student[experience]">
                            <option value="有">有</option>
                            <option value="無" selected>無</option>
                        </select>
                    </p>
                </div>
                <textarea name="student[description]" placeholder="特記事項" ></textarea>
                <input type="submit" value="store" />
            </form>
            <div class="back">[ <a href="/">back</a> ]</div>
    </body>
</html>
        