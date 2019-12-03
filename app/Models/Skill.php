<?php

namespace App\Models;

class Skill extends Model
{
    protected $table = 'skills';

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|UserProfile[]
     */
    public function profiles()
    {
        return $this->belongsToMany(UserProfile::class);
    }
}
