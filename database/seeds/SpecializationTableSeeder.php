<?php

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en' => 'Arabic', 'ar' => 'عربي'],
            ['en' => 'English', 'ar' => 'انجليزي'],
            ['en' => 'Sciences', 'ar' => 'علوم'],
            ['en' => 'studies', 'ar' => 'دراسات'],
            ['en' => 'maths', 'ar' => 'رياضيات'],
            ['en' => 'Computer', 'ar' => 'حاسب الي'],
        ];
        foreach ($specializations as $S) {
            Specialization::create(['Name' => $S]);
        }
    }
}
