<?php

declare(strict_types=1);

namespace App\Entity\Interfaces;

use App\Entity\Tag;
use Doctrine\Common\Collections\Collection;

interface TaggableInterface
{
    public function getTags(): Collection;
    public function addTag(Tag $tag): self;
    public function removeTag(Tag $tag): self;
}
