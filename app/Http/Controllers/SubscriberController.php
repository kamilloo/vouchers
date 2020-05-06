<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\Subscriber;
use App\Services\CaptchaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDOException;
use Symfony\Component\HttpFoundation\Response;

class SubscriberController extends Controller
{
    public function add(SubscribeRequest $request, Subscriber $prototype, CaptchaService $captcha_service)
    {
        try {
//            $verified = $captcha_service->verify($request->getCaptchaParam());
            $verified = 1;
            if ($verified)
            {
                $prototype->newInstance([
                    'email' => $request->getEmailParam()
                ])->save();

                return new JsonResponse(['message' => __('We have sent you a confirmation email')]);
            }else{
                return new JsonResponse(['message' => __('Your captcha is expired')], Response::HTTP_FAILED_DEPENDENCY);
            }

        }catch (PDOException $exception)
        {
            return new JsonResponse(['message' => __('Your email is already subscribed to list')], Response::HTTP_FAILED_DEPENDENCY);
        }
    }
}
