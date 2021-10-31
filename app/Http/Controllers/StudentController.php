<?php

namespace App\Http\Controllers;

use App\Result;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{


    public function test(Request $request)
    {
        $test = Test::query()
            ->where('id', $request->test_id)
            ->first();
        foreach ($request->results as $result) {
            Result::query()
                ->insert([
                    'user_id' => auth()->user()->getAuthIdentifier(),
                    'question_id' => $request->question_id,
                    'answer_id' => $request->answer_id
                ]);
        }

        return success_out([]);
    }

    public function getResult($test_id)
    {
        $test = Test::query()
            ->where('id', $test_id)
            ->first();
        $results = Result::query()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->where('test_id', $test_id)
            ->with(['question', 'answer'])
            ->get();

        foreach ($results as $result) {
            $result['correct'] = $result->correct;
        }

        return success_out($results);

    }

}
