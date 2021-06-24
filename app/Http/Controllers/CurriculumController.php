<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Record;
use App\Curriculum;
use App\Curriculum_record;

class CurriculumController extends Controller
{
    public function record(Student $student) {
        $students = $student->get();
        return view('curriculum.record')->with(['students' => $students]);
    }
    
    public function test() {
        return view('vuetest');
    }
    
    
    public function fetch(Request $request) {
        $student_class = $request->value;
        $student_name = Student::where('class', $student_class)->pluck('name');
        return $student_name;
    }
    
    
    public function store(Request $request, Student $student) {
        
        $curriculum = new Curriculum;
        $curriculum->student_id = $request->input('student_id');
        $input = $request['curriculum'];
        $curriculum->fill($input);
        $curriculum->save();
        
        $record = new Record;
        $record->id = $request->id;
        $record->student_id = $request->input('student_id');
        $record->save();
        
        $curriculum_record = new Curriculum_record;
        $curriculum_record->curriculum_id = $curriculum->id;
        $curriculum_record->record_id = $record->id;
        $curriculum_record->save();
        
        return redirect('curricula/record');
    }
}
