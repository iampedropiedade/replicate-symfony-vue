<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Serializer\AttributeGroups;
use Symfony\Component\Serializer\Annotation\Groups;

trait Fqcn
{
    #[
        Groups([
            AttributeGroups::USER_READ,
            AttributeGroups::COMPANY_READ,
        ]),
    ]
    public function getFqcn(): ?string
    {
        return get_class($this);
    }
}
