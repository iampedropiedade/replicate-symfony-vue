<?php

declare(strict_types=1);

namespace App\Model\Replicate\Response;

use App\Model\Replicate\Common\Input;

class Prediction
{
    private string $id;
    private string $version;
    private Input $input;
    protected string $status;
    protected string $createdAt;
    protected Urls $urls;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUrls(): Urls
    {
        return $this->urls;
    }

    public function setUrls(Urls $urls): self
    {
        $this->urls = $urls;
        return $this;
    }



}
