<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Validator\Constants as ValidatorConstants;
use App\Validator\Constraint\NoEmojis;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Serializer\AttributeGroups;
use OpenApi\Attributes as OA;

trait FullName
{
    #[
        ORM\Column(type: 'string', length: 200),
        OA\Property(example: 'Joe'),
        Groups([AttributeGroups::USER_READ, AttributeGroups::USER_WRITE]),
        Assert\Length(min: 2, max: 50),
        Assert\NotBlank,
        NoEmojis,
        Assert\Regex(pattern: ValidatorConstants::NAME_REGEX_PATTERN, message: ValidatorConstants::NAME_REGEX_MESSAGE),
        Assert\Regex(pattern: ValidatorConstants::NAME_START_REGEX_PATTERN, message: ValidatorConstants::NAME_START_REGEX_MESSAGE)
    ]
    private string $firstName;

    #[
        ORM\Column(type: 'string', length: 200),
        OA\Property(example: 'Bloggs'),
        Groups([AttributeGroups::USER_READ, AttributeGroups::USER_WRITE]),
        Assert\Length(min: 2, max: 50),
        Assert\NotBlank,
        NoEmojis,
        Assert\Regex(pattern: ValidatorConstants::NAME_REGEX_PATTERN, message: ValidatorConstants::NAME_REGEX_MESSAGE),
        Assert\Regex(pattern: ValidatorConstants::NAME_START_REGEX_PATTERN, message: ValidatorConstants::NAME_START_REGEX_MESSAGE)
    ]
    private string $lastName;

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    #[Groups([AttributeGroups::USER_READ])]
    public function getName(): string
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }
}
