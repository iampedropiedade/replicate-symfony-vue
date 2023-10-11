<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

use App\Entity\User;

interface BlamableInterface
{
    public function getCreatedBy(): ?User;
    public function setCreatedBy(?User $createdBy): self;
    public function getLastUpdatedBy(): ?User;
    public function setLastUpdatedBy(?User $createdBy): self;
}
