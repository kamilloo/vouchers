<?php

namespace App\Exceptions;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class VoucherUsed extends HttpException  implements Responsable
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
