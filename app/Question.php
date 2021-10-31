<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $fillable = ['description', 'test_id'];


    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function getCountAnswers(){
        $answers = Answer::query()->where('question_id', $this->id)->get();
        return count($answers->toArray());
    }

}
