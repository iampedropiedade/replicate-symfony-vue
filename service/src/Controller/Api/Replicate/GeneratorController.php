<?php

declare(strict_types=1);

namespace App\Controller\Api\Replicate;

use App\Client\Replicate\Exceptions\ReplicateException;
use App\Client\Replicate\PredictionsClient;
use App\Controller\Api\AbstractApiController;
use App\Model\Replicate\Request\Prediction;
use App\Model\Replicate\Response\Predictions;
use App\Model\Request\Marketing;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/replicate/generator', priority: 10)]
class GeneratorController extends AbstractApiController
{

    #[Route('', name: 'api_generator', methods: ['POST'])]
    public function prediction(Request $request, PredictionsClient $predictionsClient): Response
    {
        $predictions = new Predictions();
        /** @var Marketing $marketing */
        $marketing = $this->serializer->deserialize(
            $request->getContent(),
            Marketing::class,
            'json'
        );
        if($marketing->isSloganSelected()) {
            try {
                $predictions->addPrediction('slogan', $predictionsClient->request($marketing->getSloganPrompt(), self::BASE_APP_URL . $this->generateUrl('webhook_replicate_slogan')));
            }
            catch (ReplicateException $e) {
                $predictions->addError('slogan', $e->getMessage());
            }
        }
        if($marketing->isContentSelected()) {
            try {
                $predictions->addPrediction('content', $predictionsClient->request($marketing->getContentPrompt(), self::BASE_APP_URL . $this->generateUrl('webhook_replicate_content')));
            }
            catch (ReplicateException $e) {
                $predictions->addError('content', $e->getMessage());
            }
        }
        if($marketing->isImageSelected()) {
            try {
                $predictions->addPrediction('image', $predictionsClient->request($marketing->getImagePrompt(), self::BASE_APP_URL . $this->generateUrl('webhook_replicate_image'), PredictionsClient::MODEL_STABILITY, 1500));
            }
            catch (ReplicateException $e) {
                $predictions->addError('image', $e->getMessage());
            }
        }
        return JsonResponse::fromJsonString($this->serializer->serialize($predictions, 'json'));
    }
    
}
