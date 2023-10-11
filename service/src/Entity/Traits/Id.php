<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Serializer\AttributeGroups;
use OpenApi\Attributes as OA;

trait Id
{
    #[
        ORM\Id,
        ORM\GeneratedValue,
        ORM\Column(type: 'integer', nullable: false),
        Groups([AttributeGroups::USER_READ, AttributeGroups::COMPANY_READ]),
        OA\Property(example: 1),
    ]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id = null): self
    {
        $this->id = $id;
        return $this;
    }
}
