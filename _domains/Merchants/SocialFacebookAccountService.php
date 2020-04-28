<?php
declare(strict_types=1);

namespace Domain\Merchants;

use App\Models\SocialFacebookAccount;
use App\Models\Template;
use App\Models\User;
use Hash;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);
            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => Hash::make(bin2hex(openssl_random_pseudo_bytes(8))),
//                    'name' => $data['name'],
//                    'email' => $data['email'],
//                    'password' => Hash::make($data['password']),
                ]);

                $merchant = $user->merchant()->create();
                $merchant->template()->associate(Template::first())->save();
                $user->profile()->create();
            }
            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
