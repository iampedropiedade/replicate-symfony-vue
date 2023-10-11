<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Serializer\AttributeGroups;
use Symfony\Component\Validator\Constraints as Assert;

trait DateOfBirth
{
    #[
        ORM\Column(type: 'datetime', nullable: true),
        Groups(AttributeGroups::USER_READ),
        Assert\LessThanOrEqual('today', message: 'The date of birth should should not be greater than today.'),
        Assert\GreaterThanOrEqual('-100 years', message: 'The date of birth should not go back more than 100 years.')
    ]
    private ?DateTime $dateOfBirth = null;

    public function getDateOfBirth(): ?DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?DateTime $dateOfBirth): self
    {
        $dateOfBirth?->setTime(0, 0);
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    public function getDateOfBirthForHumans(): string
    {
        return $this->getDateOfBirth() ? $this->getDateOfBirth()->format('d-m-Y') : '';
    }

    public function getDateOfBirthIso(): string
    {
        if ($this->getDateOfBirth() === null) {
            return '';
        }
        return Carbon::instance($this->getDateOfBirth())->toIso8601String();
    }
}
