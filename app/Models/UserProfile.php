<?php

namespace App\Models;

use App\Models\User;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = [
        'address',
        'company_name',
        'first_name',
        'last_name',
        'services',
        'avatar',
        'logo',
        'description',
        'branch',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
