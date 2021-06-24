<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <title>面談フォーム</title>
    </head>
    
    <body>
        <h1>カリキュラム面談</h1>
        
            <form action="/curricula", method="POST", enctype="multipart/form-data" >
                @csrf
                <div class="record">
                  <select id="student_class" name="student_class" class="parent">
                    @foreach($students as $student)
                        <option value="{{ $student->class }}">{{ $student->class }}</option>
                    @endforeach
                  </select>期生
                  <select id="student_id" name="student_id" class="children">
                    @foreach($students as $student)
                       <option value="{{ $student->id }}">{{ $student->student_name }}</option>
                    @endforeach
                  </select>さん
                 
                    <p>進捗：
                        <select name="curriculum[progress]">
                            @foreach(config('section') as $key => $value)
                              <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </p>
                    
                    <p>質問
                        <br>
                        <textarea name="curriculum[question]"></textarea>
                    </p>
                    
                    <p>次の目標：
                        <select name="curriculum[aim]">
                            @foreach(config('section') as $key => $value)
                              <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </p>
                    
                    <p>次回面談予定：
                        <input name="curriculum[nextdate]" type="date">
                    </p>
                </div>
                    
                <input type="submit" value="store" />
            </form>
            <div class="back">[ <a href="/">back</a> ]</div>
       <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    </body>
</html>
        