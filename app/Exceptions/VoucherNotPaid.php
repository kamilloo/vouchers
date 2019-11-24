<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class VoucherNotPaid extends HttpException
{
    public function __construct(int $statusCode = 0, string $message = null, \Exception $previous = null, array $headers = [], ?int $code = 0)
    {
        parent::__construct(424, __('Voucher not paid'), $previous, $headers, $code);
    }
}
