<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gate;

use App\Student;
use App\Grade;
use App\User;
use App\Record;
use App\Curriculum_record;
use App\Curriculum;
use App\Project_record;
use App\Project;
use App\GoogleSheet;

class StudentController extends Controller {
    
    //生徒一覧表示
    public function index(Student $student, Curriculum_record $curriculum_record, Project_record $project_record) {
    
        $students = Student::with('user')->get(); //リレーション関係にあるものも一緒に渡す
        //dd($students->sortBy('enter'));
        // //最新の進捗出したいやつ
        // //$studentsはコレクション！		  
        //$students = $student->get();
        // $records = Record::all();
        // $latests = new Collection([]);
        // $return = new Collection([]);
        // foreach($students as $student) {
            
        //     $exist = DB::table('records')->where('student_id', $student->id)->exists();
        //     if($exist) {
        //         $latests->push($records->sortByDesc('created_at')
        // 		              ->whereIn('student_id', $student->id)
        // 		              ->first());
        		
        // 		$curriculum_records = $curriculum_record->get();
        //         $id1 = $curriculum_records->pluck('record_id')->toArray();
        //         $project_records = $project_record->get();
        //         $id2 = $project_records->pluck('record_id')->toArray();
        //         $results = new Collection([]);
        //         foreach($latests as $latest) {
        //             $key1 = in_array($latest->id, $id1);
        //             $key2 = in_array($latest->id, $id2);
        //             if($key1) {
        //                 $curriculum_id = Curriculum_record::query()->where('record_id', '=', $latest->id)->get('curriculum_id')->toArray();
        //                 $curriculum = Curriculum::query()->whereIn('id', $curriculum_id)->get();
        //                 $results = $results->concat($curriculum);
        //             } else if ($key2) {
        //                 $project_id = Project_record::query()->where('record_id', '=', $latest->id)->get('project_id')->toArray();
        //                 $project = Project::query()->whereIn('id', $project_id)->get();
        //                 $results = $results->concat($project);
        //             }
        //         }
        //         //$students = $students->concat($results);
        //         //$results = $students->concat($results)->sortBy('student_id');
        //         //$student = $student->concat($results);
        //         $result = $results->toArray();
        //         $item = array_merge($student->toArray(), $result[0]);
        //         $return = $return->concat(collect($item));
        //     } else {
        //         //$return = array_push($return, $student->toArray());
        //         //print_r($return);
        //         //$return = $return->concat((collect($student)));
        //     }
        //}
        //dd($students);
        return $students;
    }
    
    //生徒詳細表示
    public function show(Student $student) {
        //$description = $student->description;
        return $student;
	}
	
	//進捗記録表示
	public function record(Student $student) {
	    $records = Record::query()->where('student_id', '=', $student->id)->get('id')->toArray();
		//Curriculum検索
		$curriculum_id = Curriculum_record::query()->whereIn('record_id', $records)->get('curriculum_id')->toArray();
		$curricula = Curriculum::query()->whereIn('id', $curriculum_id)->get();
		//Project検索
		$project_id = Project_record::query()->whereIn('record_id', $records)->get('project_id')->toArray();
		$projects = Project::query()->whereIn('id', $project_id)->get();
		//二つのColectionをまとめて日付で降順に
		$results = $curricula->concat($projects)->sortByDesc('updated_at');
		return $results;
	    
	}
	
	// 理解度のグラフをつくる
	public function level(Student $student) {
	    if(isset($student->sheet_id)) {
	        $sheets = GoogleSheet::instance();
            $sheet_id = $student->sheet_id;
            $range = 'B12:I46';
            $response = $sheets->spreadsheets_values->get($sheet_id, $range);
            $values = $response->getValues();
    
            $levels = array();
            foreach($values as $value) {
                $check = count($value);
                if ($check == 7) {
                    $understanding = str_replace('%', '', $value[5]);
                    array_push($levels, ["section"=>$value[0] , "understanding"=>$understanding]);
                } else {
                    continue;
                }
            }
            return $levels;
	    } 
	} 
	
	//セクションを出す
	public function label() {
	    $students = Student::all();
	    $sections = array();
	    foreach($students as $student){
	        if(isset($student->sheet_id)) {
	        $sheets = GoogleSheet::instance();
            $sheet_id = $student->sheet_id;
            $range = 'B12:I46';
            $response = $sheets->spreadsheets_values->get($sheet_id, $range);
            $values = $response->getValues();
            foreach($values as $value) {
                $check = count($value);
                if ($check == 7) {
                    array_push($sections, $value[0]);
                } else {
                    continue;
                }
            }
            return $sections;
	        } 
	    }
	}
    
    //生徒登録画面表示
    public function create() {
        return view('student.create');
    }
    
    //生徒登録処理
    public function store(Student $student, Request $request)	{
        $data = $request->all();
        $student->fill($data);
        $student->save();
        return $student;
	}
	
	//生徒編集登録
	public function update(Student $student, Request $request)	{
	    if (Gate::allows('editStudent', $student)){
        $data = $request->all();
        $student->fill($data);
        $student->save();
        return $student;
    	//return redirect('/students/' . $student->id);
	    } else {
	        echo ("403 unauthorized");
	    }
	}
	
	//生徒情報削除
	public function destroy(Student $student) {
	    $student->delete();
	    return $student;
	}
	
	//完了度グラフをつくる
	public function clear() {
	    $students = Student::all();
	    $counts = array();
	    foreach ($students as $student) {
	        if(isset($student->sheet_id)) {
	            $sheets = GoogleSheet::instance();
                $sheet_id = $student->sheet_id;
                $range = 'B12:I46';
                $response = $sheets->spreadsheets_values->get($sheet_id, $range);
                $values = $response->getValues();
            
                //TRUE・FALSEのセルだけ抜き出す。
                $i=0;
                foreach($values as $key => $value) {
                    foreach($value as $sub_key => $sub_value) {
                        if($sub_key == 6) {
                            $checks = array();
                            $checks = $checks + array($sub_key => $sub_value);
                            //print_r($checks);
                            foreach($checks as $key => $value) {
                                if ($value === "TRUE") {
                                        $i++;
                                }   
                            }
                        } else {
                            continue;
                        }
                    }
                }
                array_push($counts, ["name" => $student->student_name, "clear" => $i]);
	        } else {
	            continue;
	        }
	    }
        return $counts;
	}
	
	//完了度の表を作る
	public function table() {
	    $students = Student::all();
	    $params = array();
	    foreach ($students as $student) {
	        $clears = array();
	        if(isset($student->sheet_id)) {
	            $sheets = GoogleSheet::instance();
                $sheet_id = $student->sheet_id;
                $range = 'B12:I46';
                $response = $sheets->spreadsheets_values->get($sheet_id, $range);
                $values = $response->getValues();
                //dd($values);
                //TRUE・FALSEのセルだけ抜き出す。
                foreach($values as $value) {
                    $check = count($value);
                    if ($check == 7 || $check == 8) {
                        if ($value[6] == "TRUE") {
                            $color = "table-tutuji";
                        } else {
                            $color = "table-light";
                        }
                        array_push($clears, $color);
                    } else {
                        continue;
                    }  
                }
	        }
	        array_push($params, $clears);
	    }
	    return [$students, $params];
	}
	
	//入学年月を選択肢として送る
	public function enter(Student $student) {
	    $enter = array_merge($student->get('enter')->unique('enter')->sortBy('enter')->toArray());
	    return $enter;
	}
	
	//入学年月で生徒を絞り込む
	public function select($enter) {
	    $students = Student::query()
	                ->where('enter', '=', $enter)
	                ->where('user_id', '=', Auth::id())
	                ->get();
	    return $students;
	}
	

}
