<?php

namespace App\Http\Controllers;

use App\Models\Grade;

class testController extends Controller
{
    public function index()
    {
        return Grade::all()->id;
        // $classrooms = [
        //     ['en' => 'First grade', 'ar' => 'الصف الاول'],
        //     ['en' => 'Second grade', 'ar' => 'الصف الثاني'],
        //     ['en' => 'Third grade', 'ar' => 'الصف الثالث'],
        //     ['en' => 'Forth grade', 'ar' => 'الصف الرابع'],
        //     ['en' => 'Fifth grade', 'ar' => 'الصف الخامس'],
        //     ['en' => 'Sixth grade', 'ar' => 'الصف السادس'],
        // ];

        // for ($i = 0; $i < 6; $i++) {
        //     return $classrooms[5];
        // }

        // foreach ($classrooms as $classroom) {
        //     return $classroom;
        // }
    }
}
