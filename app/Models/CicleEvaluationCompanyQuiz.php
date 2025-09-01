<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CicleEvaluationCompanyQuiz extends Model
{
    use SoftDeletes;

    protected $table = 'cicleEvaluationCompanyQuiz';

    protected $guarded = [];
}
