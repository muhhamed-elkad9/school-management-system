<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable
{
    use HasTranslations;
    use SoftDeletes;

    public $translatable = ['name', 'roles_name'];
    protected $guarded = [];

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
    }

    public function Sections()
    {
        return $this->belongsTo('App\Models\Sections', 'section_id');
    }

    public function nationalitie()
    {
        return $this->belongsTo('App\Models\Nationalitie', 'nationalitie_id');
    }

    public function blood()
    {
        return $this->belongsTo('App\Models\Type_Blood', 'blood_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\My_Parent', 'parent_id');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    // علاقة بين جدول سدادت الطلاب وجدول الطلاب لجلب اجمالي المدفوعات والمتبقي
    public function student_account()
    {
        return $this->hasMany('App\Models\StudentAccount', 'student_id');
    }

    // علاقة بين جدول الطلاب وجدول الحضور والغياب
    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance', 'student_id');
    }
}
