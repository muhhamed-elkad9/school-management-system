<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Sections extends Model
{
    use HasTranslations;

    public $translatable = ['Name_Section'];

    protected $fillable = ['Name_Section', 'Status', 'Grade_id', 'Class_id'];

    protected $table = 'sections';
    public $timestamps = true;

    public function ClassRooms()
    {
        return $this->belongsTo('App\Models\ClassRoom', 'Class_id');
    }

    public function Grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }
}
