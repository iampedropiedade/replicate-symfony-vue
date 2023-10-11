<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Serializer\AttributeGroups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid as CoreUuid;

trait Uuid
{
    #[
        ORM\Column(type: 'string', length: 36, unique: true, nullable: false),
        Groups(AttributeGroups::USER_READ)
    ]
    protected string $uuid = '';

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    #[ORM\PrePersist]
    public function generateUuid(): self
    {
        $this->uuid = $this->uuid !== '' ? $this->uuid : (string) CoreUuid::v4();
        return $this;
    }
}
