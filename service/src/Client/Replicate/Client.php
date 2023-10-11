<?php

declare(strict_types=1);

namespace App\Client\Replicate;

use App\Client\AbstractClient\AbstractClient;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client extends AbstractClient
{
    protected string $replicateVersionLlama2;
    protected string $replicateVersionStabilityAi;

    public function __construct(
        HttpClientInterface $replicate,
        SerializerInterface $serializer,
        LoggerInterface $logger,
        string $replicateVersionLlama2,
        string $replicateVersionStabilityAi
    ) {
        $this->client = $replicate;
        $this->serializer = $serializer;
        $this->logger = $logger;
        $this->replicateVersionLlama2 = $replicateVersionLlama2;
        $this->replicateVersionStabilityAi = $replicateVersionStabilityAi;
    }
}
