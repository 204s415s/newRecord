<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum_record extends Model
{
    public function curriculum() {
        return $this->belongsTo(Curriculum::class);
    }
    
    public function record() {
        return $this->belongsTo(Record::class);
    }
}
