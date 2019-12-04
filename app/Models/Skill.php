<?php

namespace App\Models;

class Skill extends Model
{
    protected $table = 'skills';

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|User[]
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'skill_user', 'skill_id', 'user_id');
    }
}
