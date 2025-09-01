<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // Constantes para los roles
    const ADMIN = 1;
    const MANAGER = 2;
    const USER = 3;

    /**
     * Relationship with User
     */
    public function users()
    {
        return $this->hasMany(User::class, 'roleId');
    }

    /**
     * Check if role is admin
     */
    public function isAdmin()
    {
        return $this->id === self::ADMIN;
    }

    /**
     * Check if role is manager
     */
    public function isManager()
    {
        return $this->id === self::MANAGER;
    }

    /**
     * Check if role is user
     */
    public function isUser()
    {
        return $this->id === self::USER;
    }
}
