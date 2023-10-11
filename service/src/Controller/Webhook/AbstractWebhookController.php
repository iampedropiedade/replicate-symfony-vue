<?php

declare(strict_types=1);

namespace App\Controller\Webhook;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractWebhookController extends AbstractController
{
    public function __construct(
        protected readonly SerializerInterface $serializer
    )
    {
    }
}
