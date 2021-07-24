<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    
    protected $fillable = [
        'student_id',
        'progress',
        'question',
        'aim',
        'next',
        'style'
        // 'nextdate',
        // 'nexttime'
    ];
    
    public function curriculum_record() {
        return $this->belongsTo(Curriculum::class);
    }
    
    public function students() {
        return $this->belongsTo(Student::class);
    }
    
}
