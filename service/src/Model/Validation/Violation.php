<?php

declare(strict_types=1);

namespace App\Model\Validation;

use App\Serializer\AttributeGroups;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\ConstraintViolationInterface;

class Violation
{
    #[Groups(AttributeGroups::VIOLATIONS)]
    protected string $propertyPath;

    #[Groups(AttributeGroups::VIOLATIONS)]
    protected string $title;

    #[Groups(AttributeGroups::VIOLATIONS)]
    protected string $invalidValue;

    protected ?ConstraintViolationInterface $constraintViolation;

    public function __construct(?ConstraintViolationInterface $constraintViolation = null)
    {
        if ($constraintViolation !== null) {
            $this->constraintViolation = $constraintViolation;
            $this->setTitle(strval($this->constraintViolation->getMessage()));
            $this->setPropertyPath($this->constraintViolation->getPropertyPath());
            $this->setPropertyPath($this->constraintViolation->getPropertyPath());
        }
    }

    public function getPropertyPath(): string
    {
        return $this->propertyPath;
    }

    public function setPropertyPath(string $propertyPath): self
    {
        $this->propertyPath = $propertyPath;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Violation
    {
        $this->title = $title;
        return $this;
    }

    #[Groups(AttributeGroups::VIOLATIONS)]
    public function getInvalidValue(): string
    {
        if ($this->constraintViolation === null) {
            return '[unknown]';
        }
        if (is_object($this->constraintViolation->getInvalidValue())) {
            return '[object]';
        }
        if (is_array($this->constraintViolation->getInvalidValue())) {
            return '[array]';
        }
        return strval($this->constraintViolation->getInvalidValue());
    }

    #[Groups(AttributeGroups::VIOLATIONS)]
    public function getPropertyName(): string
    {
        $listOfWords = preg_split('/(?=[A-Z\.])/', $this->propertyPath);
        if ($listOfWords === false) {
            return $this->propertyPath;
        }
        $words = array_map(static function ($value) {
            return ucfirst(trim($value, '.'));
        }, $listOfWords);
        return implode(' ', $words);
    }
}
