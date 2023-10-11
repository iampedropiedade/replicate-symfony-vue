<?php

declare(strict_types=1);

namespace App\Model\Replicate\Request;

use App\Model\Replicate\Common\Input;

class Prediction
{
    private string $version;
    private Input $input;
    private string $webhook;

    public function __construct(string $input, string $webhook, string $version, ?int $maxTokens)
    {
        $this->input = (new Input())->setPrompt($input)->setMaxNewTokens($maxTokens);
        $this->webhook = $webhook;
        $this->version = $version;
;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    public function getInput(): Input
    {
        return $this->input;
    }

    public function setInput(Input $input): self
    {
        $this->input = $input;
        return $this;
    }

    public function getWebhook(): string
    {
        return $this->webhook;
    }

    public function setWebhook(string $webhook): self
    {
        $this->webhook = $webhook;
        return $this;
    }
}
