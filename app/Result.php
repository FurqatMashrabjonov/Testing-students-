<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function getCorrectAttribute(){
        $right_answer = RightAnswer::query()
            ->where('question_id', $this->id)
            ->where('answer_id', $this->answer_id)
            ->first();
        return !empty($right_answer);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function answer(){
        return $this->belongsTo(Answer::class);
    }
}
