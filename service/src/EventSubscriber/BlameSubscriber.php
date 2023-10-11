<?php

namespace App\EventSubscriber;

use App\Entity\Interfaces\BlamableInterface;
use App\Entity\User;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Symfony\Bundle\SecurityBundle\Security;

#[
    AsDoctrineListener(event: Events::prePersist),
    AsDoctrineListener(event: Events::preUpdate),
]
class BlameSubscriber
{
    public function __construct(
        protected readonly Security $security,
    ) {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();
        if (! ($entity instanceof BlamableInterface)) {
            return;
        }
        $user = $this->security->getUser() instanceof User ? $this->security->getUser() : null;
        if ($entity->getCreatedBy() === null) {
            $entity->setCreatedBy($user);
        }
        if ($entity->getLastUpdatedBy() === null) {
            $entity->setLastUpdatedBy($user);
        }
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof BlamableInterface) {
            $user = $this->security->getUser() instanceof User ? $this->security->getUser() : null;
            $entity->setLastUpdatedBy($user);
        }
    }
}
