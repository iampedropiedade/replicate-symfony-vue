<?php

declare(strict_types=1);

namespace App\Validator\Validator;

use App\Validator\Constraint\NoEmojis;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class NoEmojisValidator extends ConstraintValidator
{
    protected const REGEXES = [
        '/[\x{1F100}-\x{1F1FF}]/u',
        '/[\x{1F300}-\x{1F5FF}]/u',
        '/[\x{1F600}-\x{1F64F}]/u',
        '/[\x{1F680}-\x{1F6FF}]/u',
        '/[\x{1F900}-\x{1F9FF}]/u',
        '/[\x{2600}-\x{26FF}]/u',
        '/[\x{2700}-\x{27BF}]/u',
    ];

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (! ($constraint instanceof NoEmojis)) {
            throw new UnexpectedTypeException($constraint, NoEmojis::class);
        }
        if ($value === null) {
            return;
        }
        if (is_string($value) === false) {
            throw new UnexpectedValueException($constraint, 'string');
        }
        if ($this->detect($value) === true) {
            $this->context
                ->buildViolation('Emojis are not allowed on this field')
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }

    protected function detect(string $string): bool
    {
        foreach (self::REGEXES as $regex) {
            preg_match($regex, $string, $results);
            if (count($results) > 0) {
                return true;
            }
        }
        return false;
    }
}
