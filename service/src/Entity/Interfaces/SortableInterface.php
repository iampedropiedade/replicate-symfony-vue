<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

interface SortableInterface
{
    public function getSortPosition(): int;
    public function setSortPosition(int $sortPosition): self;
}
