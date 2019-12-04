<?php

namespace App\Models;

class Branch extends Model
{
    protected $table = 'branches';

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|User[]
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'branch_user', 'branch_id', 'user_id');
    }
}
