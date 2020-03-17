<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDOException;
use Symfony\Component\HttpFoundation\Response;

class SubscriberController extends Controller
{
    public function add(SubscribeRequest $request, Subscriber $prototype)
    {
        try {
            $prototype->newInstance([
                'email' => $request->getEmailParam()
            ])->save();

            return new JsonResponse(['message' => __('We have sent you a confirmation email')]);
        }catch (PDOException $exception)
        {
            return new JsonResponse(['message' => __('Your email is already subscribed to list')], Response::HTTP_FAILED_DEPENDENCY);
        }
    }
}
