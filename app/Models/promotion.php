<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
    protected $guarded = [];

    public function students()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function Grade()
    {
        return $this->belongsTo('App\Models\Grade', 'from_grade');
    }

    public function Classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'from_Classroom');
    }

    public function Sections()
    {
        return $this->belongsTo('App\Models\Sections', 'from_section');
    }

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'to_grade');
    }

    public function Classrooms()
    {
        return $this->belongsTo('App\Models\Classroom', 'to_Classroom');
    }

    public function Sectionss()
    {
        return $this->belongsTo('App\Models\Sections', 'to_section');
    }
}
