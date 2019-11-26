<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class VoucherExpired extends HttpException
{
    /**
     * @return string
     */
    protected function message():string
    {
        return __('Voucher expired');
    }

    /**
     * @return string
     */
    protected function code(): int
    {
        return Response::HTTP_FAILED_DEPENDENCY;
    }
}
