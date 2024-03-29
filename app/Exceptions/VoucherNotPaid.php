<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class VoucherNotPaid extends HttpException
{
    /**
     * @return string
     */
    protected function message():string
    {
        return __('Voucher not paid');
    }

    /**
     * @return string
     */
    protected function code(): int
    {
        return Response::HTTP_FAILED_DEPENDENCY;
    }
}
