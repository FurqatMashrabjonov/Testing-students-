<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
            $test = new \App\Test();
            $test->name = \Illuminate\Support\Str::random(100);
            $test -> user_id = 1;
            $test->start_date = Carbon::now();
            $test->end_date = Carbon::now()->addHour();
            $test->token = \Illuminate\Support\Str::random(20);
            $test->status_id = 1;
            $test->time = 40;
            $test->save();
        }
    }
}
