<?php

declare(strict_types=1);

namespace App\Validator;

class Constants
{
    public const PASSWORD_MIN_LENGTH = 8;
    public const PASSWORD_MAX_LENGTH = 50;
    public const PASSWORD_REGEX_PATTERN = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{' . self::PASSWORD_MIN_LENGTH . ',}$/';
    public const PASSWORD_REGEX_MESSAGE =
        'Please type a password ' . self::PASSWORD_MIN_LENGTH . ' to ' . self::PASSWORD_MAX_LENGTH . ' characters in 
        length, at least one lowercase letter, at least one uppercase letter and at least one number';

    public const EMAIL_REGEX_PATTERN = '/^((?!\.@).)*$/';
    public const EMAIL_REGEX_MESSAGE = 'Please use a valid email - a full stop cannot be used before the @ char.';

    public const HANDLE_REGEX_PATTERN = '/^[a-z0-9-_]*$/';
    public const HANDLE_REGEX_MESSAGE =
        'Please use only lowercase letters, numbers, underscores or dashes for the handle. Example: create-a-campaign.';

    public const ICON_REGEX_PATTERN = self::HANDLE_REGEX_PATTERN;
    public const ICON_REGEX_MESSAGE =
        'Please use only lowercase letters, numbers, underscores or dashes for the icon. Example: square-210.';

    public const PHONE_REGEX_PATTERN = '/(^$)|(^!*([0-9 ()+-]!*){8,20}$)/';
    public const PHONE_REGEX_MESSAGE = 'Please use a valid phone number.';

    public const DOMAIN_REGEX_PATTERN =
        '/^(((?!\-))(xn\-\-)?[a-z0-9\-_]{0,61}[a-z0-9]{1,1}\.)*(xn\-\-)?([a-z0-9\-]{1,61}|[a-z0-9\-]{1,30})\.[a-z]{2,}$/';
    public const DOMAIN_REGEX_MESSAGE = 'Please use a valid domain name.';

    public const COMPANY_REGISTRATION_REGEX_PATTERN = '/^[0-9]*$/';
    public const COMPANY_REGISTRATION_REGEX_MESSAGE = 'Please use numbers only.';

    public const COMPANY_VAT_GB_PREFIX = 'GB';
    public const COMPANY_VAT_REGEX_PATTERN = '/^$|^((GB)?([0-9]{9}([0-9]{3})?|[A-Z]{2}[0-9]{3}))$/';
    public const COMPANY_VAT_REGEX_MESSAGE = 'Please use a valid UK VAT number with the GB prefix and 9 digits. Example: GB123456789.';

    public const NAME_REGEX_PATTERN = "/^[a-zA-Z\\xC0-\\x{FFFF}]+([ \\-']{0,1}[a-zA-Z\\xC0-\\x{FFFF}]+){0,2}[.]{0,1}$/u";
    public const NAME_REGEX_MESSAGE = 'Please use a valid name with no symbols.';

    public const NAME_START_REGEX_PATTERN = "/^\p{Lu}/u";
    public const NAME_START_REGEX_MESSAGE = 'Please start with an uppercase letter.';
}
