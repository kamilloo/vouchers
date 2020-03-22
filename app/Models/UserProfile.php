<?php

namespace App\Models;

use App\Models\EntitySchemas\SocialMedia;
use App\Models\User;

/**
 * @property SocialMedia[] $social_media
 *
 */
class UserProfile extends Model
{
    protected $primaryKey = 'user_id';

    protected $table = 'user_profiles';


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'social_media' => 'array',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
