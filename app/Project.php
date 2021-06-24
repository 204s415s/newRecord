<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = [
        'student_id',
        'progress',
        'topical',
        'question',
        'aim',
        'nextdate',
    ];
    
    public function project_record() {
        return $this->belongsTo(Project_record::class);
    }
    
    public function student() {
        return $this->belongsTo(Student::class);
    }
}
