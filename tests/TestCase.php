<?php

namespace Tests;

use App\Models\Merchant;
use App\Models\Template;
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
        $this->seed(\CreateTemplates::class);
        $this->createUser();
        $this->be($this->user);
        $this->addProfileAndMerchant();
    }

    protected function createUserAndBeFromApi()
    {
        $this->seed(\CreateTemplates::class);
        $this->createUser();
        $this->be($this->user, 'api');
        $this->addProfileAndMerchant();
    }

    protected function createUser(): User
    {
        $this->user = factory(User::class)->create();
        return $this->user;
    }

    protected function addProfileAndMerchant(): void
    {
        $this->addMerchant($this->user);
        $this->addProfile($this->user);
    }

    protected function makeProfile(): UserProfile
    {
        return factory(UserProfile::class)->make();
    }

    protected function createProfile(): UserProfile
    {
        return factory(UserProfile::class)->make();
    }

    protected function addProfile(User $user):UserProfile
    {
        $user_profile = $this->makeProfile();
        $user->profile()->save($user_profile);
        return $user_profile;
    }

    protected function addMerchant(User $user):Merchant
    {
        $merchant = $this->makeMerchant();
        $merchant->template()->associate(Template::first());
        $user->merchant()->save($merchant);
        return $merchant;
    }

    /**
     * @return mixed
     */
    protected function makeMerchant(): Merchant
    {
        return factory(Merchant::class)->make();
    }
}
