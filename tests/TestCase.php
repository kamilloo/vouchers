<?php

namespace Tests;

use App\Models\Merchant;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var User
     */
    protected $user;

    protected function createUserAndBe()
    {
        $this->user = factory(User::class)->create();
        $this->be($this->user);
        $this->user->profile()->save(factory(UserProfile::class)->make());
        $this->user->merchant()->save(factory(Merchant::class)->make());
    }
}
