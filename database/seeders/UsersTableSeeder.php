<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Sami Mansour',
            'email'=>'sami@gmail.com',
            'password'=>bcrypt('123123123'),
        ]);

        User::create([
            'name'=>'Mind CMS',
            'email'=>'mindscms@gmail.com',
            'password'=>bcrypt('123123123'),
        ]);

        User::create([
            'name'=>'Another User',
            'email'=>'another@gmail.com',
            'password'=>bcrypt('123123123'),
        ]);
    }
}
