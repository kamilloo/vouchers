<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CaptchaService
{
    const CAPTCHA_API = 'https://www.google.com/recaptcha/api/siteverify';
    /**
     * @var \Illuminate\Http\Client\Factory
     */
    protected $client;

    public function verify(string $captcha):bool
    {
        $response = Http::post(self::CAPTCHA_API, [
            'secret' => config('captcha.secret'),
            'response' => $captcha
        ]);

        return $response->ok() && $response->json()['success'];
    }
}
