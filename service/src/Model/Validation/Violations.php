<?php

declare(strict_types=1);

namespace App\Model\Validation;

use App\Serializer\AttributeGroups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

class Violations
{
    /** @var Collection<Violation>  */
    #[Groups(AttributeGroups::VIOLATIONS)]
    protected Collection $violations;

    public function __construct(?ConstraintViolationListInterface $violations = null)
    {
        $this->violations = new ArrayCollection();
        if ($violations !== null) {
            foreach ($violations as $constraintViolation) {
                $this->addViolation($constraintViolation);
            }
        }
    }

    /**
     * @return Collection<Violation>
     */
    public function getViolations(): Collection
    {
        return $this->violations;
    }

    public function addViolations(ConstraintViolationListInterface $violations): self
    {
        foreach ($violations as $constraintViolation) {
            $this->addViolation($constraintViolation);
        }
        return $this;
    }

    public function addViolation(ConstraintViolationInterface $constraintViolation): self
    {
        $this->violations->add(new Violation($constraintViolation));
        return $this;
    }

    /**
     * @param array<Violation> $violations
     *
     * @return $this
     */
    public function setViolations(array $violations): self
    {
        $this->violations = new ArrayCollection($violations);
        return $this;
    }

    public function hasPathViolation(string $path): bool
    {
        foreach ($this->violations as $violation) {
            if ($violation->getPropertyPath() === $path) {
                return true;
            }
        }
        return false;
    }

    public function getPathViolation(string $path): ?string
    {
        foreach ($this->violations as $violation) {
            if ($violation->getPropertyPath() === $path) {
                return $violation->getTitle();
            }
        }
        return null;
    }

    public function addViolationFromMessage(string $message, ?string $path = null): self
    {
        $violation = new Violation();
        $violation->setTitle($message);
        if ($path !== null) {
            $violation->setPropertyPath($path);
        }
        $this->violations->add($violation);
        return $this;
    }

    public function addExceptionViolation(Throwable $exception): self
    {
        $violation = new Violation();
        $violation->setTitle($exception->getMessage());
        $this->violations->add($violation);
        return $this;
    }

    public function asString(): string
    {
        $violations = [];
        foreach ($this->violations as $violation) {
            $violations[] = $violation->getTitle();
        }
        return implode(', ', $violations);
    }
}
