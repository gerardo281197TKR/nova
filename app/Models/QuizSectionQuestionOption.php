<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizSectionQuestionOption extends Model
{
    use SoftDeletes;

    protected $table = 'quizSectionQuestionOption';

    protected $guarded = [];
}
