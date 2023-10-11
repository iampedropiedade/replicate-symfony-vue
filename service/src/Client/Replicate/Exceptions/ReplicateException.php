<?php

declare(strict_types=1);

namespace App\Client\Replicate\Exceptions;

use App\Client\AbstractClient\Exceptions\ApiClientException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ReplicateException extends ApiClientException
{
    protected const MESSAGES = [
        400 => 'Invalid.',
        401 => 'API error.',
        403 => 'Access error.',
        404 => 'Not found.',
        500 => 'Internal error.',
    ];

    /** @var string */
    protected $message;

    /** @var int */
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;

    public function __construct(string $message = 'There was an error retrieving the prediction details', int $code = 0, ?Throwable $previous = null)
    {
        $exceptionMessage = self::MESSAGES[$code] ?? $message;
        parent::__construct($exceptionMessage, $code, $previous);
    }
}
