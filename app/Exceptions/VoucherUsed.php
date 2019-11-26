<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class VoucherUsed extends HttpException
{
    /**
     * @return string
     */
    protected function message():string
    {
        return __('Voucher used');
    }

    /**
     * @return string
     */
    protected function code(): int
    {
        return Response::HTTP_FAILED_DEPENDENCY;
    }
}
