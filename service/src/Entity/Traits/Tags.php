<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Entity\Tag;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Serializer\AttributeGroups;

trait Tags
{
    /** @var Collection<Tag> */
    #[
        ORM\ManyToMany(targetEntity: Tag::class, cascade: ['persist', 'detach']),
        Groups(AttributeGroups::USER_READ)
    ]
    private Collection $tags;

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (! $this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }
        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);
        return $this;
    }
}
