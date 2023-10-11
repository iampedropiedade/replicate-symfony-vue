<?php

declare(strict_types=1);

namespace App\Client\AbstractClient\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiClientException extends Exception implements Throwable
{
    /** @var string */
    protected $message = 'API client exception';

    /** @var int */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}
