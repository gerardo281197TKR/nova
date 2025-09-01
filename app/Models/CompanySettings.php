<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySettings extends Model
{
    use SoftDeletes;

    protected $table = 'companySettings';

    protected $guarded = [];
}
