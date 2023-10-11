<?php

declare(strict_types=1);

namespace App\Serializer;

class AttributeGroups
{
    // Generic
    public const VIOLATIONS = 'violations';

    // Audit Log
    public const AUDIT_LOG_READ = 'audit_log_write';
    public const AUDIT_LOG_WRITE = 'audit_log_read';
    public const AUDIT_LOG_ALL_ARRAY = [self::AUDIT_LOG_READ, self::AUDIT_LOG_WRITE];

    // User
    public const USER_READ = 'user_write';
    public const USER_WRITE = 'user_read';
    public const USER_ALL_ARRAY = [self::USER_READ, self::USER_WRITE];

    // Company
    public const COMPANY_WRITE = 'company_read';
    public const COMPANY_READ = 'company_write';
    public const COMPANY_ALL_ARRAY = [self::COMPANY_READ, self::COMPANY_WRITE];

}
