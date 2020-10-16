<?php


namespace App\Infrastructure\Ports\Secondary;

use MatCaps\Beta\Domain\Entity\Auth\User;
use MatCaps\Beta\Domain\Gateway\UserGateway;

use function array_filter;

class LoginRepository implements UserGateway
{
    /** @var array<User>  */
    private array $users = [];

    /**
     * @param string $username
     * @param string $password
     * @return User|null
     */
    public function findOneByUsernameAndPassword(string $username, string $password): ?User
    {
        return array_values(array_filter($this->users, static function (User $user) use ($username) {
            return $user->getUsername() === $username;
        }))[0] ?? null;
    }

    /**
     * @param User $user
     */
    public function add(User $user): void
    {
        $this->users[$user->getId()] = $user;
    }
}
