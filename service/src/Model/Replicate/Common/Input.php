<?php

declare(strict_types=1);

namespace App\Model\Replicate\Common;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Input
{
    protected const MAX_NEW_TOKENS = 750;

    protected string $prompt;

    #[SerializedName('max_new_tokens')]
    protected int $maxNewTokens = self::MAX_NEW_TOKENS;

    #[SerializedName('system_prompt')]
    protected string $systemPrompt = 'You are a helpful, respectful and honest marketing assistant. 
    No introduction. No pre-amble. No explanations.  
    Your answers should not include any harmful, unethical, racist, sexist, toxic, dangerous, or illegal content. 
    Please ensure that your responses are socially unbiased and positive in nature.
    ';

    public function getPrompt(): string
    {
        return $this->prompt;
    }

    public function setPrompt(string $prompt): self
    {
        $this->prompt = $prompt;
        return $this;
    }

    public function getSystemPrompt(): string
    {
        return $this->systemPrompt;
    }

    public function setSystemPrompt(string $systemPrompt): Input
    {
        $this->systemPrompt = $systemPrompt;
        return $this;
    }

    public function getMaxNewTokens(): int
    {
        return $this->maxNewTokens;
    }

    public function setMaxNewTokens(?int $maxNewTokens): Input
    {
        $this->maxNewTokens = $maxNewTokens ?? self::MAX_NEW_TOKENS;
        return $this;
    }

}
