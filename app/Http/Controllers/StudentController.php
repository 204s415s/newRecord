<?php

namespace App\Http\Controllers;

use App\Student;
use App\Grade;
use App\User;
use App\Record;
use App\Curriculum_record;
use App\Curriculum;
use App\Project_record;
use App\Project;
use App\GoogleSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Student $student, Curriculum_record $curriculum_record, Project_record $project_record) {
        //$students = $student->get();
        //$login = Auth::user();
        
        ////////////////////
        /*
        //最新の進捗出したいやつ
        //$students_idはコレクション！		  
        $students_id = $student->get();
        //$user = $student->users;
        //$recordsもコレクション
        $records = Record::all();
        $latests = new Collection([]);
        foreach($students_id as $student_id) {
        	$latests->push($records->sortByDesc('created_at')
        		              ->whereIn('student_id', $student_id->id)
        		              ->first());
        }
        
        $curriculum_records = $curriculum_record->get();
        $id1 = $curriculum_records->pluck('record_id')->toArray();
        $project_records = $project_record->get();
        $id2 = $project_records->pluck('record_id')->toArray();
        $results = new Collection([]);
        
        foreach($latests as $latest) {
            //Curriculum_recordsにあるか探す
            $key1 = in_array($latest->id, $id1);
            $key2 = in_array($latest->id, $id2);
            if($key1) {
                $curriculum_id = Curriculum_record::query()->where('record_id', '=', $latest->id)->get('curriculum_id')->toArray();
                $curriculum = Curriculum::query()->whereIn('id', $curriculum_id)->get();
                $results = $results->concat($curriculum);
            } else if ($key2) {
                $project_id = Project_record::query()->where('record_id', '=', $latest->id)->get('project_id')->toArray();
                $project = Project::query()->whereIn('id', $project_id)->get();
                $results = $results->concat($project);
            }
        }
        **/
        /////////////////////////////
        //$results = $students->concat($results)->sortBy('student_id');
        //return view('student.index', compact('students', 'results', 'login'));
        
        
        
        $students = Student::with('user', 'grade')->get(); //リレーション関係にあるものも一緒に渡す
        return $students;
    }
    
    public function show(Student $student) {
        //学年の情報も渡す
		$grade = Grade::query()->where('id', '=', $student->grade_id)->get('value');
		
		//$user = Auth::user();
		$records = Record::query()->where('student_id', '=', $student->id)->get('id')->toArray();
		//Curriculum検索
		$curriculum_id = Curriculum_record::query()->whereIn('record_id', $records)->get('curriculum_id')->toArray();
		$curricula = Curriculum::query()->whereIn('id', $curriculum_id)->get();
		//Project検索
		$project_id = Project_record::query()->whereIn('record_id', $records)->get('project_id')->toArray();
		$projects = Project::query()->whereIn('id', $project_id)->get();
		//二つのColectionをまとめて日付で降順に
		$results = $curricula->concat($projects)->sortByDesc('updated_at');
		
    	return [$student, $grade];
	}
    
    public function create() {
        return view('student.create');
    }
    
    public function grade(Grade $grade) {
        $grades = $grade->all();
        return $grades;
    }
    
    public function store(Student $student, Request $request)	{
       $data = $request->all();
	   $student->fill($data);
	   $student->save();
	   return $student;
	 }
	
	public function update(Student $student, Request $request)	{
    	$input = $request['student'];
	    $student->fill($input);
	    $student->user_id = Auth::id();
	    $student->save();
    	//return redirect('/students/' . $student->id);
	}
	
	public function destroy(Student $student) {
	    $student->delete;
	    return $student;
	}
}
