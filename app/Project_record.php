<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_record extends Model
{
    public function project() {
        return $this->belongsTo(Project::class);
    }
    
    public function record() {
        return $this->belongsTo(Record::class);
    }
}
