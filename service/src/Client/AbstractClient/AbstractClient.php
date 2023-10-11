<?php

declare(strict_types=1);

namespace App\Client\AbstractClient;

use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractClient
{
    protected HttpClientInterface $client;
    protected SerializerInterface $serializer;
    protected LoggerInterface $logger;

    /** @var array<string>  */
    protected array $endpointParts = [];

    /** @var array<string, string|int|array<string, int|string>>  */
    protected array $requestData = [];

    /**
     * @param array<string, string|int|array<string, int|string>> $requestData
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function get(array $requestData = []): ResponseInterface
    {
        return $this->client->request('GET', $this->buildApiUrl(), array_merge($this->requestData, $requestData));
    }

    /**
     * @param array<string, string|int|array<string, int|string>> $requestData
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function put(array $requestData = []): ResponseInterface
    {
        return $this->client->request('PUT', $this->buildApiUrl(), array_merge($this->requestData, $requestData));
    }

    /**
     * @param array<string, string|int|array<string, int|string>> $requestData
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function delete(array $requestData = []): ResponseInterface
    {
        return $this->client->request('DELETE', $this->buildApiUrl(), array_merge($this->requestData, $requestData));
    }

    /**
     * @param array<string, string|int|array<string, int|string>> $requestData
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function post(array $requestData = []): ResponseInterface
    {
        return $this->client->request('POST', $this->buildApiUrl(), array_merge($this->requestData, $requestData));
    }

    /**
     * @param array<string, string|int|array<string, int|string>> $requestData
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function patch(array $requestData = []): ResponseInterface
    {
        return $this->client->request('PATCH', $this->buildApiUrl(), array_merge($this->requestData, $requestData));
    }

    public function buildApiUrl(): string
    {
        return implode('/', $this->endpointParts);
    }

    /**
     * @param string|array<string, array<string, int|string>|int|string> $body
     *
     * @return $this
     */
    public function setRequestBody(array|string $body): self
    {
        $this->requestData['body'] = $body; /** @phpstan-ignore-line */
        return $this;
    }

    /**
     * @param string|array<string, array<string, int|string>|int|string> $body
     *
     * @return $this
     */
    public function setRequestJson(array|string $body): self
    {
        $this->requestData['json'] = $body; /** @phpstan-ignore-line */
        return $this;
    }

    /**
     * @param array<string, string|int>|null $query
     *
     * @return $this
     */
    public function setQuery(?array $query): self
    {
        $this->requestData['query'] = $query; /** @phpstan-ignore-line */
        return $this;
    }

    /**
     * @param array<string, string|int>|null $query
     *
     * @return $this
     */
    public function addToQuery(?array $query): self
    {
        $this->requestData['query'] =
            ! isset($this->requestData['query']) ||
            ! is_array($this->requestData['query']) ||
            count($this->requestData['query']) === 0 ? [] : $this->requestData['query'];
        $this->requestData['query'] = array_merge($this->requestData['query'], $query); /** @phpstan-ignore-line */
        return $this;
    }

    /**
     * @return $this
     */
    public function addKeyToQuery(string $key, int|string|float $value): self
    {
        $this->requestData['query'] =
            ! isset($this->requestData['query']) ||
            ! is_array($this->requestData['query']) ||
            count($this->requestData['query']) === 0 ? [] : $this->requestData['query'];
        $this->requestData['query'][$key] = $value; /** @phpstan-ignore-line */
        return $this;
    }

    /**
     * @return array<string, int|string>|int|string
     */
    public function getQuery(): array|int|string
    {
        return $this->requestData['query'];
    }

    public function addHeader(string $key, string $value): self
    {
        $this->requestData['headers'][$key] = $value; /** @phpstan-ignore-line */
        return $this;
    }

    protected function addToEndpoint(string ...$parts): void
    {
        $this->endpointParts = array_merge($this->endpointParts, $parts);
    }

    protected function resetEndpoint(): void
    {
        $this->endpointParts = [];
    }

    /**
     * @return array<string>
     */
    protected function getEndpoint(): array
    {
        return $this->endpointParts;
    }

    protected function setEndpoint(string ...$parts): void
    {
        $this->endpointParts = $parts;
    }
}
