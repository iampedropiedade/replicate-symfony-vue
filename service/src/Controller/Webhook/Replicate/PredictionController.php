<?php

declare(strict_types=1);

namespace App\Controller\Webhook\Replicate;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\Replicate\Webhook\Prediction;
use Psr\Log\LoggerInterface;

#[Route('/webhook/replicate/prediction', priority: 10)]
class PredictionController extends AbstractReplicateWebhookController
{
    #[Route('/slogan', name: 'webhook_replicate_slogan', methods: ['GET', 'POST'])]
    public function slogan(Request $request, HubInterface $hub, LoggerInterface $logger): Response
    {
        $prediction = $this->serializer->deserialize(
            $request->getContent(),
            Prediction::class,
            'json'
        );
        $logger->debug('Content: {content}', ['content' => $request->getContent()]);
        $predictionData = $this->serializer->serialize($prediction, 'json');
        $update = new Update(
            'predictions/update/slogan/' . $prediction->getId(),
            $predictionData
        );
        $hub->publish($update);
        return new Response();
    }

    #[Route('/content', name: 'webhook_replicate_content', methods: ['GET', 'POST'])]
    public function content(Request $request, HubInterface $hub, LoggerInterface $logger): Response
    {
        $prediction = $this->serializer->deserialize(
            $request->getContent(),
            Prediction::class,
            'json'
        );
        $logger->debug('Content: {content}', ['content' => $request->getContent()]);
        $predictionData = $this->serializer->serialize($prediction, 'json');
        $update = new Update(
            'predictions/update/content/' . $prediction->getId(),
            $predictionData
        );
        $hub->publish($update);
        return new Response();
    }

    #[Route('/image', name: 'webhook_replicate_image', methods: ['GET', 'POST'])]
    public function image(Request $request, HubInterface $hub, LoggerInterface $logger): Response
    {
        $prediction = $this->serializer->deserialize(
            $request->getContent(),
            Prediction::class,
            'json'
        );
        $logger->debug('Content: {content}', ['content' => $request->getContent()]);
        $predictionData = $this->serializer->serialize($prediction, 'json');
        $update = new Update(
            'predictions/update/image/' . $prediction->getId(),
            $predictionData
        );
        $hub->publish($update);
        return new Response();
    }
}
