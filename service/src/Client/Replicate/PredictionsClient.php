<?php

declare(strict_types=1);

namespace App\Client\Replicate;

use App\Client\Replicate\Exceptions\ReplicateException;
use App\Model\Replicate\Request\Prediction;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use App\Model\Replicate\Response\Prediction as PredictionModel;

class PredictionsClient extends Client
{
    protected const ENDPOINT = '/v1/predictions';
    public const MODEL_LLAMA2 = 'llama2';
    public const MODEL_STABILITY = 'stability';

    /**
     * @throws ReplicateException
     */
    public function request(string $prompt, string $webhook, string $model = self::MODEL_LLAMA2, int $maxTokens = null): PredictionModel
    {
        $prediction = new Prediction($prompt, $webhook, $model === self::MODEL_LLAMA2 ? $this->replicateVersionLlama2 : $this->replicateVersionStabilityAi, $maxTokens);
        $this->resetEndpoint();
        $this->addToEndpoint(self::ENDPOINT);
        try {
            $postData = $this->serializer->normalize($prediction, 'json');
            $this->setRequestJson($postData);
            $response = $this->post();
            /** @var PredictionModel $model */
            $model = $this->serializer->deserialize(
                $response->getContent(),
                PredictionModel::class,
                'json',
            );
            return $model;
        } catch (HttpExceptionInterface | TransportExceptionInterface | NotEncodableValueException $exception) {
            throw new ReplicateException($exception->getMessage(), $exception->getCode());
        }
    }
}
