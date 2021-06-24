<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>面談フォーム</title>
    </head>
    
    <body>
        <h1>成果物面談</h1>
            <form action="/projects", method="POST", enctype="multipart/form-data" >
                @csrf
                <div class="record">
                  <select>
                    @foreach($students as $student)
                        <option value="{{ $student->class }}">{{ $student->class }}</option>
                    @endforeach
                  </select>期生
                  <select name="student_id">
                    @foreach($students as $student)
                       <option value="{{ $student->id }}">{{ $student->student_name }}</option>
                    @endforeach
                  </select>さん
                
                    <p>進捗：
                        <textarea name="project[progress]" type="text"></textarea>
                    </p>
                    
                    <p>特筆事項：
                        <input name="project[topical]"></input>
                    </p>
                    
                    <p>質問
                        <br>
                        <textarea name="project[question]"></textarea>
                    </p>
                    
                    <p>次の目標：
                        <textarea name="project[aim]"></textarea>
                    </p>
                    
                    <p>次回面談予定：
                        <input name="project[nextdate]" type="date">
                    </p>
                </div>
                    
                <input type="submit" value="store" />
            </form>
            <div class="back">[ <a href="/">back</a> ]</div>
    </body>
</html>
        