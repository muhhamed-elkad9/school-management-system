<?php

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('classrooms')->delete();
        $classrooms = [
            ['en' => 'First grade', 'ar' => 'الصف الاول'],
            ['en' => 'Second grade', 'ar' => 'الصف الثاني'],
            ['en' => 'Third grade', 'ar' => 'الصف الثالث'],
            ['en' => 'Forth grade', 'ar' => 'الصف الرابع'],
            ['en' => 'Fifth grade', 'ar' => 'الصف الخامس'],
            ['en' => 'Sixth grade', 'ar' => 'الصف السادس'],
        ];

        foreach ($classrooms as $classroom) {
            Classroom::create([
                    'Name_Class' => $classroom,
                    'Grade_id' => Grade::all()->unique()->random()->id,
                ]);
        }
        // Classroom::create([
        //     'Name_Class' => $classrooms[0],
        //     // 'Grade_id' => Grade::where('id', 1)->get('Name')[0],
        //     'Grade_id' => Grade::where()->unique()->id,
        // ]);
        // Classroom::create([
        //     'Name_Class' => $classrooms[1],
        //     'Grade_id' => Grade::where('id', 1)->get('Name'),
        // ]);
        // Classroom::create([
        //     'Name_Class' => $classrooms[2],
        //     'Grade_id' => Grade::where('id', 1)->get('Name'),
        // ]);
        // Classroom::create([
        //     'Name_Class' => $classrooms[3],
        //     'Grade_id' => Grade::where('id', 1)->get('Name'),
        // ]);
        // Classroom::create([
        //     'Name_Class' => $classrooms[4],
        //     'Grade_id' => Grade::where('id', 1)->get('Name'),
        // ]);
        // Classroom::create([
        //     'Name_Class' => $classrooms[5],
        //     'Grade_id' => Grade::where('id', 1)->get('Name'),
        // ]);
    }
}
