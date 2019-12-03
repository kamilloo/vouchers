<?php

namespace App\Models;

class Branch extends Model
{
    protected $table = 'branches';

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|UserProfile[]
     */
    public function profiles()
    {
        return $this->belongsToMany(UserProfile::class);
    }
}
