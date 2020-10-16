<?php

namespace MatCaps\Beta\Domain\Gateway;

use MatCaps\Beta\Domain\Entity\Auth\User;

interface UserGateway
{
    /**
     * @param string $username
     * @param string $password
     * @return User|null
     */
    public function findOneByUsernameAndPassword(string $username, string $password): ?User;

    /**
     * @param User $user
     */
    public function add(User $user): void;
}
