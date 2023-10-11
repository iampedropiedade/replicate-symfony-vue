<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Validator\Constants as ValidatorConstants;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Serializer\AttributeGroups;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Attributes as OA;

trait Email
{
    #[
        ORM\Column(type: 'string', length: 200, unique: true),
        Groups([AttributeGroups::USER_WRITE, AttributeGroups::USER_READ]),
        OA\Property(example: 'jbloggs@rawnet.com'),
        Assert\Email,
        Assert\NotNull,
        Assert\NotBlank,
        Assert\Regex(pattern: ValidatorConstants::EMAIL_REGEX_PATTERN, message: ValidatorConstants::EMAIL_REGEX_MESSAGE)
    ]
    private string $email;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
}
