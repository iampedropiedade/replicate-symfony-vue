<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Entity\User;
use App\Serializer\AttributeGroups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait Blame
{
    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['detach'])]
    private ?User $createdBy = null;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['detach'])]
    private ?User $lastUpdatedBy = null;

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getLastUpdatedBy(): ?User
    {
        return $this->lastUpdatedBy;
    }

    public function setLastUpdatedBy(?User $lastUpdatedBy): self
    {
        $this->lastUpdatedBy = $lastUpdatedBy;
        return $this;
    }

    #[Groups([AttributeGroups::USER_READ, AttributeGroups::COMPANY_READ])]
    public function getLastUpdatedByName(): ?string
    {
        return $this->lastUpdatedBy?->getName();
    }
}
