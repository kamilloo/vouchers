<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 * @property Merchant $merchant
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $with = ['profile'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'user_id');
    }

    public function merchant()
    {
        return $this->hasOne(Merchant::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Skill[]
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user', 'user_id', 'skill_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Branch[]
     */
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_user', 'user_id', 'branch_id');
    }

    public function isMerchant()
    {
        return $this->merchant()->count() > 0;
    }
}
