<?php

declare(strict_types=1);

namespace App\Entity;

use App\Attribute\Auditable;
use App\Validator\Constants;
use App\Entity\Interfaces\BlamableInterface;
use App\Entity\Interfaces\TimestampedInterface;
use App\Entity\Interfaces\IdInterface;
use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;
use Stringable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid as CoreUuid;
use Symfony\Component\Validator\Constraints as Assert;
use App\Serializer\AttributeGroups;
use App\Validator\Constraint\NoEmojis;
use OpenApi\Attributes as OA;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[
    ORM\Entity(repositoryClass: CompanyRepository::class),
    ORM\HasLifecycleCallbacks,
    ORM\Index(columns: ['name'], name: 'idx_company_name'),
    UniqueEntity(fields: ['vatNumber'], message: 'This VAT Number is already in user by another Company. Please use a unique VAT Number.'),
    Auditable(ignoredAttributes: ['uuid'])
]
class Company implements TimestampedInterface, Stringable, IdInterface, BlamableInterface
{
    use Traits\Id;
    use Traits\Timestamps;
    use Traits\Blame;
    use Traits\Fqcn;

    #[ORM\Column(type: 'string', length: 36, nullable: false)]
    protected string $uuid = '';

    #[
        ORM\Column(type: 'string', length: 200, nullable: true),
        Groups(AttributeGroups::COMPANY_ALL_ARRAY),
        OA\Property(example: 'GB123456789'),
        NoEmojis
    ]
    protected string $name;

    #[
        ORM\Column(type: 'string', length: 200, nullable: true),
        Groups(AttributeGroups::COMPANY_ALL_ARRAY),
        Assert\Regex(pattern: Constants::COMPANY_VAT_REGEX_PATTERN, message: Constants::COMPANY_VAT_REGEX_MESSAGE),
        OA\Property(example: 'GB123456789'),
        NoEmojis
    ]
    private ?string $vatNumber = null;

    public function __construct()
    {
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    #[
        ORM\PrePersist,
        ORM\PreUpdate,
    ]
    public function generateUuid(): self
    {
        $this->uuid = $this->uuid !== '' ? $this->uuid : (string) CoreUuid::v4();
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(?string $vatNumber): Company
    {
        $this->vatNumber = $vatNumber;
        return $this;
    }

}
