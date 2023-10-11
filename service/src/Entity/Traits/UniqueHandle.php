<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Validator\Constants as ValidatorConstants;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Serializer\AttributeGroups;

trait UniqueHandle
{
    #[
        ORM\Column(type: 'string', length: 200, unique: true, nullable: false),
        Groups(AttributeGroups::USER_READ),
        Assert\NotBlank,
        Assert\NotNull,
        Assert\Length(min: 2, max: 200),
        Assert\Regex(pattern: ValidatorConstants::HANDLE_REGEX_PATTERN, message: ValidatorConstants::HANDLE_REGEX_MESSAGE),
    ]
    private string $handle = '';

    public function getHandle(): string
    {
        return $this->handle;
    }

    public function setHandle(string $handle): self
    {
        $this->handle = $handle;
        return $this;
    }
}
