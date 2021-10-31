<?php

use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=0;$i<200;$i++){
            \App\Answer::query()->create([
                'description' => \Illuminate\Support\Str::random(50),
                'question_id' => \App\Question::all()->random()->id,

            ]);
        }
    }
}
