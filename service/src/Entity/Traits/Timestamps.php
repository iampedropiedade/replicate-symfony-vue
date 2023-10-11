<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Serializer\AttributeGroups;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;

trait Timestamps
{
    #[
        ORM\Column(type: 'datetime'),
        Groups([AttributeGroups::USER_READ, AttributeGroups::COMPANY_READ])
    ]
    private DateTimeInterface $createdAt;
    private ?DateTimeInterface $createdAtDate = null;

    #[
        ORM\Column(type: 'datetime'),
        Groups([AttributeGroups::USER_READ, AttributeGroups::COMPANY_READ])
    ]
    private DateTimeInterface $updatedAt;
    private ?DateTimeInterface $updatedAtDate = null;

    #[
        Groups([AttributeGroups::USER_READ, AttributeGroups::COMPANY_READ])
    ]
    public function getCreatedAtAgo(): string
    {
        return Carbon::instance($this->getCreatedAt())->diffForHumans();
    }


    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt ?? new DateTime();
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): self
    {
        $this->createdAt = $this->createdAtDate ?? new DateTime();
        return $this;
    }

    public function setCreatedAtDate(DateTime $createdAtDate): self
    {
        $this->createdAtDate = $createdAtDate;
        return $this;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt ?? new DateTime();
    }

    #[
        ORM\PrePersist,
        ORM\PreUpdate
    ]
    public function setUpdatedAt(): self
    {
        $this->updatedAt = $this->updatedAtDate ?? new DateTime();
        return $this;
    }

    public function resetUpdatedAt(): self
    {
        $this->updatedAt = new DateTime();
        return $this;
    }

    public function setUpdatedAtDate(?DateTime $updatedAtDate = null): self
    {
        $this->updatedAtDate = $updatedAtDate;
        return $this;
    }

    public function getUpdatedAtAgo(): string
    {
        return Carbon::instance($this->getUpdatedAt())->diffForHumans();
    }

    public function getUpdatedAtIso(): string
    {
        return Carbon::instance($this->getUpdatedAt())->toIso8601String();
    }

    public function getCreatedAtIso(): string
    {
        return Carbon::instance($this->getCreatedAt())->toIso8601String();
    }

    public function getCreatedAtHuman(): string
    {
        return Carbon::instance($this->getCreatedAt())->format('d-m-Y H:i:s');
    }
}
