<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<200;$i++){
            \App\Question::query()->create([
                'description' => \Illuminate\Support\Str::random(100),
                'test_id' => \App\Test::all()->random()->id,
                'status_id' => 1
            ]);
        }
    }
}
