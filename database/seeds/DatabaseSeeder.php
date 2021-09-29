<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\User::query()->create([
            'name' => 'Furqat Mashrabjonov',
            'email' => 'php_lesson@mail.ru',
            'password' => bcrypt('willywilliam')
        ]);
    }
}
