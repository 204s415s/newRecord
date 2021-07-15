<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Record;
use App\Curriculum;
use App\Curriculum_record;

class CurriculumController extends Controller
{

    public function index() {
        $curriculum = Curriculum::get();
        return $curriculum;
    }
    
    public function fetch(Request $request) {
        $student_class = $request->value;
        $student_name = Student::where('class', $student_class)->pluck('name');
        return $student_name;
    }
    
    
    public function store(Request $request, Student $student) {
        $curriculum = new Curriculum;
        $input = $request->all();
        $curriculum->fill($input)->save();
        
        $record = new Record;
        $record->student_id = $request->input('student_id');
        $record->save();
        
        $curriculum_record = new Curriculum_record;
        $curriculum_record->curriculum_id = $curriculum->id;
        $curriculum_record->record_id = $record->id;
        $curriculum_record->save();
        
        return compact($curriculum, $record, $curriculum_record);
    }
}
