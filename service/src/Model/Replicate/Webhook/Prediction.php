<?php

declare(strict_types=1);

namespace App\Model\Replicate\Webhook;

class Prediction
{
    private string $id;
    private string $version;
    private string $status;
    private ?array $output;
    private ?string $error;
    private ?string $logs;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Prediction
    {
        $this->id = $id;
        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): Prediction
    {
        $this->version = $version;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Prediction
    {
        $this->status = $status;
        return $this;
    }

    public function getOutput(): ?array
    {
        return $this->output;
    }

    public function setOutput(?array $output): Prediction
    {
        $output = implode('', $output);
        $this->output = explode("\n", $output);
        return $this;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function setError(?string $error): Prediction
    {
        $this->error = $error;
        return $this;
    }

    public function getLogs(): ?string
    {
        return $this->logs;
    }

    public function setLogs(?string $logs): Prediction
    {
        $this->logs = $logs;
        return $this;
    }

}
