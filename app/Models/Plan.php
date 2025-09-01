<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Relationship with Company
     */
    public function companies()
    {
        return $this->hasMany(Company::class, 'planId');
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    /**
     * Check if plan is basic
     */
    public function isBasic()
    {
        return $this->cicleEvaluationsUsersAvailables <= 15;
    }

    /**
     * Check if plan is intermediate
     */
    public function isIntermediate()
    {
        return $this->cicleEvaluationsUsersAvailables > 15 && $this->cicleEvaluationsUsersAvailables <= 50;
    }

    /**
     * Check if plan is advanced
     */
    public function isAdvanced()
    {
        return $this->cicleEvaluationsUsersAvailables > 50;
    }
}
