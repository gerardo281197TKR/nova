<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CicleEvaluationUser extends Model
{
    use SoftDeletes;

    protected $table = 'cicleEvaluationUser';

    protected $guarded = [];
}
