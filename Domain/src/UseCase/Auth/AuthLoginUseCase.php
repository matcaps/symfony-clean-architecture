<?php

namespace MatCaps\Beta\Domain\UseCase\Auth;

use MatCaps\Beta\Domain\Entity\Auth\User;
use MatCaps\Beta\Domain\Exception\Auth\InvalidUserException;
use MatCaps\Beta\Domain\Gateway\UserGateway;
use MatCaps\Beta\Domain\Request\Auth\LoginRequest;

/**
 * Class AuthLoginUseCase
 * @package MatCaps\Beta\Domain\UseCase\Auth
 */
class AuthLoginUseCase
{
    /** @var LoginRequest */
    private LoginRequest $request;
    /** @var UserGateway */
    private UserGateway $repository;

    /**
     * AuthLoginUseCase constructor.
     * @param LoginRequest $request
     * @param UserGateway $userRepository
     */
    public function __construct(LoginRequest $request, UserGateway $userRepository)
    {
        $this->request = $request;
        $this->repository = $userRepository;
    }

    /**
     * @return User|null
     * @throws InvalidUserException
     */
    public function execute(): ?User
    {
        $result = $this->repository->findOneByUsernameAndPassword(
            $this->request->getUsername(),
            $this->request->getPassword()
        );

        if (null === $result) {
            throw new InvalidUserException("User cannot be authenticated");
        }

        return $result;
    }



    /**
     * @return LoginRequest
     */
    public function getRequest(): LoginRequest
    {
        return $this->request;
    }

    /**
     * @return UserGateway
     */
    public function getRepository()
    {
        return $this->repository;
    }
}
