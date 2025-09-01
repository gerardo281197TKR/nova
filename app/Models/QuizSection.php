<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizSection extends Model
{
    use SoftDeletes;

    protected $table = 'quizSection';

    protected $guarded = [];
}
