<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

use App\Validator\Validator\NoEmojisValidator;
use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class NoEmojis extends Constraint
{
    #[HasNamedArguments]
    public function __construct(?array $groups = null, mixed $payload = null)
    {
        parent::__construct([], $groups, $payload);
    }

    public function getTargets(): string|array
    {
        return self::PROPERTY_CONSTRAINT;
    }

    public function validatedBy(): string
    {
        return NoEmojisValidator::class;
    }
}
