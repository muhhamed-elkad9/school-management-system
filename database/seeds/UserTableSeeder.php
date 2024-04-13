<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $users = new User();
        $users->name = ['ar' => 'محمد القاضي', 'en' => 'Mohamed Elkady'];
        $users->email = 'ma9212440@gmail.com';
        $users->password = Hash::make('123456789');
        $users->save();
    }
}
