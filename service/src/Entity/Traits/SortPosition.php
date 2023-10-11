<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait SortPosition
{
    #[ORM\Column(type: 'integer')]
    private int $sortPosition = 999999;

    public function getSortPosition(): int
    {
        return $this->sortPosition;
    }

    public function setSortPosition(int $sortPosition): self
    {
        $this->sortPosition = $sortPosition;
        return $this;
    }
}
