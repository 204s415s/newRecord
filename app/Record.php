<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public function student() {
        return $this->belongsTo(Student::class);
    }
    
    public function curriculum_record() {
        return $this->belongsTo(Curriculum_record::class);
    }
    
    public function project_record() {
        return $this->belongsTo(Project_record::class);
    }
}
