<?php

namespace MatCaps\Beta\Domain\Tests\Auth;

use App\Infrastructure\Ports\Secondary\LoginRepository;
use MatCaps\Beta\Domain\Entity\Auth\User;
use MatCaps\Beta\Domain\Gateway\UserGateway;
use MatCaps\Beta\Domain\Request\Auth\LoginRequest;
use MatCaps\Beta\Domain\UseCase\Auth\AuthLoginUseCase;

use function beforeEach;
use function it;
use function PHPUnit\Framework\assertInstanceOf;

beforeEach(
    function () {
        $this->authLoginRequest = new LoginRequest("username", "password");
        $this->loginRepository = new LoginRepository();
    }
);

it(
    "should create a AuthLoginUseCase instance",
    function () {
        $login = new AuthLoginUseCase($this->authLoginRequest, $this->loginRepository);
        assertInstanceOf(AuthLoginUseCase::class, $login);
        assertInstanceOf(LoginRequest::class, $login->getRequest());
        assertInstanceOf(UserGateway::class, $login->getRepository());
    }
)->group('auth');

it(
    "should return a user Object",
    function () {

        $user = new User($this->authLoginRequest->getUsername(), $this->authLoginRequest->getPassword());
        $this->loginRepository->add($user);

        $login = new AuthLoginUseCase($this->authLoginRequest, $this->loginRepository);
        $user = $login->execute();

        assertInstanceOf(User::class, $user);
    }
)->group('auth');
