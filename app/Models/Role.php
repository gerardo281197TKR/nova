<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const ADMIN   = 1;
    const MANAGER = 2;
    const USER    = 3;


    protected $table = 'roles';

    protected $guarded = [];
}
