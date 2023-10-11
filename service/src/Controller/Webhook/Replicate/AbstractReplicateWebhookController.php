<?php

declare(strict_types=1);

namespace App\Controller\Webhook\Replicate;

use App\Controller\Webhook\AbstractWebhookController;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractReplicateWebhookController extends AbstractWebhookController
{
    public function __construct(
        SerializerInterface $serializer
    )
    {
        parent::__construct($serializer);
    }
}
