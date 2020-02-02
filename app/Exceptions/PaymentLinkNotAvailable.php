<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class PaymentLinkNotAvailable extends HttpException
{
    /**
     * @return string
     */
    protected function message():string
    {
        return __('Payment Link not available');
    }

    /**
     * @return string
     */
    protected function code(): int
    {
        return Response::HTTP_FAILED_DEPENDENCY;
    }
}
