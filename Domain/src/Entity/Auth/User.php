<?php

namespace MatCaps\Beta\Domain\Entity\Auth;

use function uniqid;

/**
 * Class User
 * @package MatCaps\Beta\Domain\Entity\Auth
 */
class User
{
    /** @var string */
    private string $username;
    /** @var string */
    private string $password;
    /** @var string */
    private $id;
    /** @var string  */
    private $clearPassword;

    /**
     * User constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->clearPassword = $password;
        $this->id = uniqid("user{$username}", true);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getClearPassword(): string
    {
        return $this->clearPassword;
    }
}
