<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\User;
use App\Student;
use App\Record;
use App\Curriculum_record;
use App\Curriculum;
use App\Project_record;
use App\Project;

class MypageController extends Controller {
    
    public function student(User $user) {
        $user_id = Auth::id();
        $students = Student::query()->where('user_id', '=', $user_id)->with('user')->get();
        return $students;
    }
    
    public function calendar() {
        $user_id = Auth::id();
        $students = Student::query()->where('user_id', '=', $user_id)->with('user')->get();
        $calendar = array();
        foreach($students as $student) {
            $exist = DB::table('records')->where('student_id', $student->id)->exists();
            if($exist) {
                $records = Record::query()->where('student_id', '=', $student->id)->get('id')->toArray();
                $curriculum_id = Curriculum_record::query()->whereIn('record_id', $records)->get('curriculum_id')->toArray();
                $curricula = Curriculum::query()->whereIn('id', $curriculum_id)->get();
                $project_id = Project_record::query()->whereIn('record_id', $records)->get('project_id')->toArray();
                $projects = Project::query()->whereIn('id', $project_id)->get();
                $results = $curricula->concat($projects)->sortByDesc('updated_at')->first()->toArray();
                //return [$student->student_name, $results['next']];
                array_push($calendar, ['name' => $student->student_name, 'result' =>$results['next']]);
            } else {
                continue;
            }
        }
        return $calendar;
    }
    
    public function today() {
        $user_id = Auth::id();
        $students = Student::query()->where('user_id', '=', $user_id)->get('id');
        $todays = new Collection([]);
        foreach($students as $student) {
            $today = Record::query()->where('student_id', '=', $student->id)
                                    ->whereDate('next', '=', Carbon::today())
                                    ->with('student')
                                    ->get();
            $todays = $todays->concat($today);
        }
        
        return $todays;
    }
}
