<?php

declare(strict_types=1);

namespace App\EventListener\OAuth;

use App\Entity\User;
use League\Bundle\OAuth2ServerBundle\Event\UserResolveEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserResolveEventListener
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPassword,
        private readonly UserProviderInterface $userProvider
    ) {
    }

    public function resolveUser(UserResolveEvent $event): ?UserResolveEvent
    {
        try {
            /** @var PasswordAuthenticatedUserInterface $user */
            $user = $this->userProvider->loadUserByIdentifier($event->getUsername());
        } catch (UserNotFoundException) {
            return null;
        }
        if (! $this->userPassword->isPasswordValid($user, $event->getPassword())) {
            return null;
        }
        if (($user instanceof User) && $user->isVerified() === false) {
            return null;
        }
        /** @var UserInterface $user */
        $event->setUser($user);
        return $event;
    }
}
