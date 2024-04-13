<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;
    use HasTranslations;
    public $translatable = ['Name', 'roles_name'];
    protected $guarded = [];

    public function genders()
    {
        return $this->belongsTo('App\Models\Gender', 'Gender_id');
    }

    public function Specialization()
    {
        return $this->belongsTo('App\Models\Specialization', 'Specialization_id');
    }

    public function Sections()
    {
        return $this->belongsToMany('App\Models\Sections', 'teacher_section');
    }
}
