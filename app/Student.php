<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_name',
        'enter',
        'grade_id',
        'experience',
        'description',
        'user_id'
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function grade() {
        return $this->belongsTo(Grade::class);
    }
    
    public function records() {
        return $this->hasMany(Record::class);
    }
    
    public function curricula() {
        return $this->hasMany(Curriculum::class);
    }
    
    public function projects() {
        return $this->hasMany(Project::class);
    }
}
