<?php

namespace MatCaps\Beta\Domain\Tests\Auth;

use App\Infrastructure\Ports\Secondary\LoginRepository;
use MatCaps\Beta\Domain\Entity\Auth\User;
use MatCaps\Beta\Domain\Exception\Auth\InvalidUserException;
use MatCaps\Beta\Domain\Gateway\UserGateway;
use MatCaps\Beta\Domain\Request\Auth\LoginRequest;
use MatCaps\Beta\Domain\UseCase\Auth\AuthLoginUseCase;
use PHPUnit\Framework\TestCase;

class AuthLoginTest extends TestCase
{
    private LoginRequest $authLoginRequest;
    private LoginRepository $loginRepository;

    protected function setUp(): void
    {
        $this->authLoginRequest = new LoginRequest("username", "password");
        $this->loginRepository = new LoginRepository();
    }


    public function testShouldCreateAnAuthLoginUseCaseInstance(): void
    {
        $login = new AuthLoginUseCase($this->authLoginRequest, $this->loginRepository);

        self::assertInstanceOf(AuthLoginUseCase::class, $login);
        self::assertInstanceOf(LoginRequest::class, $login->getRequest());
        self::assertInstanceOf(UserGateway::class, $login->getRepository());
    }

    public function testShouldReturnAnUserObject(): void
    {
        $user = new User($this->authLoginRequest->getUsername(), $this->authLoginRequest->getPassword());
        $this->loginRepository->add($user);

        $login = new AuthLoginUseCase($this->authLoginRequest, $this->loginRepository);
        $user = $login->execute();

        self::assertInstanceOf(User::class, $user);
    }

    public function testShouldThrowAnInvalidUserExceptionWithBadCredentials(): void
    {
        $this->expectException(InvalidUserException::class);

        $user = new User($this->authLoginRequest->getUsername(), $this->authLoginRequest->getPassword());
        $this->loginRepository->add($user);

        $errorAuthLoginRequest = new LoginRequest("username", "wrongPassword");

        $login = new AuthLoginUseCase($errorAuthLoginRequest, $this->loginRepository);
        $user = $login->execute();
    }
}
