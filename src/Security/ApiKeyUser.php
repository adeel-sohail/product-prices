<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class ApiKeyUser implements UserInterface
{
    public function __construct(private string $identifier)
    {
    }

    public function getRoles(): array
    {
        return ['ROLE_API'];
    }

    public function getUserIdentifier(): string
    {
        return $this->identifier;
    }

    public function getPassword(): ?string
    {
        return null;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        // Nothing to do
    }
}
