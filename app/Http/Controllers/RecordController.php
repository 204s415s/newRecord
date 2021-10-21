<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Student;
use App\Grade;
use App\User;
use App\Record;
use App\Curriculum_record;
use App\Curriculum;
use App\Project_record;
use App\Project;

class RecordController extends Controller
{
    public function top() {
        $user = Auth::user();
        return view('top')->with(['user' => $user]);
    }
    
    public function show(Record $record) {
        
        if($record->type == 1) {
            $curriculum_id = Curriculum_record::query()->where('record_id', $record->id)->get('curriculum_id')->toArray();
            $result = Curriculum::query()->where('id', '=', $curriculum_id)->get();
            return $result;
        } else if ($record->type == 2){
            $project_id = Project_record::query()->where('record_id', $record->id)->get('project_id')->toArray();
            $result = Project::query()->where('id', '=', $project_id)->get();
            return $result;
        }
    }
}
