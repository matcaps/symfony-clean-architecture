<?php

namespace MatCaps\Beta\Domain\Tests;

use App\Infrastructure\Ports\Secondary\TodosRepository;
use MatCaps\Beta\Domain\Entity\Todo;
use MatCaps\Beta\Domain\UseCase\ToggleTodoStatus;

use function expect;
use function it;

it(
    "should toggle a todo as done",
    function () {
        $testTodo = new Todo("MyTestTodo");
        $todoRepository = new TodosRepository(
            [
                $testTodo->getId() => $testTodo
            ]
        );

        $unDoneTodo = $todoRepository->findOneBy(['isDone' => false]);

        $useCase = new ToggleTodoStatus();
        $todo = $useCase->execute($unDoneTodo);

        expect($todo->isDone())->toBeTrue();
    }
);

it(
    "should toggle a todo as undone",
    function () {
        $testTodo = new Todo("MyTestTodo", null, true);
        $todoRepository = new TodosRepository(
            [
                $testTodo->getId() => $testTodo
            ]
        );

        $doneTodo = $todoRepository->findOneBy(['isDone' => true]);

        $useCase = new ToggleTodoStatus();
        $todo = $useCase->execute($doneTodo);

        expect($todo->isDone())->toBeFalse();
    }
);
