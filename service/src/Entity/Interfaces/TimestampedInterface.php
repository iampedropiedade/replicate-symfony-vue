<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

use DateTimeInterface;

interface TimestampedInterface
{
    public function getCreatedAt(): ?DateTimeInterface;
    public function setCreatedAt(): self;
    public function getUpdatedAt(): ?DateTimeInterface;
    public function setUpdatedAt(): self;
    public function getUpdatedAtAgo(): string;
}
