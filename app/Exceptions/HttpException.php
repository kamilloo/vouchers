<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException as HttpExceptionCore;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

abstract class HttpException extends HttpExceptionCore
{

    public function __construct(int $statusCode = 0, string $message = null, Exception $previous = null, array $headers = [], ?int $code = 0)
    {
        parent::__construct($this->code(), $this->message(), $previous, $headers, $code);
    }

    /**
     * @return string
     */
    abstract protected function message():string;
    abstract protected function code():int;

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  Request  $request
     * @return Response
     */
    public function toResponse($request)
    {
        return new JsonResponse(['message' => $this->message()], $this->code());
    }
}
