<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Record;
use App\Project;
use App\Project_record;

class ProjectController extends Controller
{
    public function record(Student $student) {
        $students = $student->get();
        return view('project.record')->with(['students' => $students]);
    }
    
    public function store(Request $request, Student $student) {
        $project = new Project;
        $project->student_id = $request->input('student_id');
        $input = $request['project'];
        $project->fill($input);
        $project->save();
        
        $record = new Record;
        $record->id = $request->id;
        $record->student_id = $request->input('student_id');
        $record->save();
        
        $project_record = new Project_record;
        $project_record->project_id = $project->id;
        $project_record->record_id = $record->id;
        $project_record->save();
        
        return redirect('projects/record');
    }
}
