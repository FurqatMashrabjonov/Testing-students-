<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Requests\TestRequest;
use App\Question;
use App\RightAnswer;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TestController extends Controller
{

    public function withToken($token)
    {
        $test = Test::query()
            ->select(['id', 'name', 'start_date', 'end_date', 'created_at', 'updated_at', 'token'])
            ->where('token', $token)
            ->first();
        $test['url'] = url('api/test/' . $test['token']);
        return success_out($test);
    }

    public function getTestWithParams($id)
    {
        $test = Test::query()
            ->where('id', $id)
            ->with(['question' => function ($query) {
                return $query->join('right_answers', 'questions.id', '=', 'right_answers.question_id')
                    ->with(['answers']);
            }])->first();
        return success_out($test);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::query()
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->orderBy('created_at', 'desc')
            ->paginate();
        for ($i = 0; $i < count($tests); $i++) {
            $tests[$i]['url'] = url('api/test/' . $tests[$i]['token']);
        }
        return success_out($tests);
    }

    public function storeItems(Request $request)
    {
        $question = new Question();
        $question->description = $request->question['description'];
        $question->status_id = 1; //vaqtincha
        $question->test_id = $request->test_id;

        if ($question->save()) {
            foreach ($request->answers as $item) {
                $answer = new Answer();
                $answer->question_id = $question->id;
                $answer->description = $item['description'];
                if ($answer->save()) {
                    if ($item['correct']) {
                        $rightAnswer = new RightAnswer();
                        $rightAnswer->question_id = $question->id;
                        $rightAnswer->answer_id = $answer->id;
                        $rightAnswer->save();
                    }
                } else {
                    return error_out(['answer' => 'Save Error']);
                }
            }
            return success_out($question);
        } else {
            return error_out(['question' => 'Save Error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        $test = new Test();
        $test->user_id = auth()->user()->getAuthIdentifier();
        $test->name = $request->name;
        $test->start_date = $request->start_date;
        $test->end_date = $request->end_date;
        $test->token = Str::random(20);
        $test->time = $request->time;
        $test->status_id = 1; //vaqtincha 1

        if ($test->save()) {
            $test['url'] = url('api/test/' . $test->token);
            return success_out($test);
        } else {
            error_out([]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Test $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Test $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Test $test
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, Test $test)
    {
        $res = $test->update($request->all());
        return ($res) ? success_out($test) : error_out([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Test $test
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Test $test)
    {
        $res = $test->delete();
        return ($res) ? success_out([]) : error_out([]);
    }
}
