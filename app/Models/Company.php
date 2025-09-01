<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Relationship with Plan
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'planId');
    }

    /**
     * Relationship with User
     */
    public function users()
    {
        return $this->hasMany(User::class, 'companyId');
    }

    /**
     * Relationship with CicleEvaluation
     */
    public function cicleEvaluations()
    {
        return $this->hasMany(CicleEvaluation::class, 'companyId');
    }

    /**
     * Get current users count
     */
    public function getCurrentUsersCount()
    {
        return $this->users()->count();
    }

    /**
     * Check if company can add more users
     */
    public function canAddUser()
    {
        $currentUsers = $this->getCurrentUsersCount();
        $maxUsers = $this->plan->cicleEvaluationsUsersAvailables;
        
        return $currentUsers < $maxUsers;
    }

    /**
     * Get remaining users slots
     */
    public function getRemainingUsersSlots()
    {
        $currentUsers = $this->getCurrentUsersCount();
        $maxUsers = $this->plan->cicleEvaluationsUsersAvailables;
        
        return max(0, $maxUsers - $currentUsers);
    }
}
