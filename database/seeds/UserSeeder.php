<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::query()->create([
            'name' => 'Furqat Teacher',
            'email' => 'teacher@mail.ru',
            'password' => bcrypt('teacher12345')
        ]);
        \App\User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.ru',
            'password' => bcrypt('admin12345'),
            'is_admin' => true
        ]);
        \App\User::query()->create([
            'name' => 'Furqat Student',
            'email' => 'student@mail.ru',
            'password' => bcrypt('student12345')
        ]);

    }
}
