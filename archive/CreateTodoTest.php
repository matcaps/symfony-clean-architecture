<?php

namespace MatCaps\Beta\Domain\Tests;

use App\Infrastructure\Ports\Secondary\TodosRepository;
use MatCaps\Beta\Domain\Entity\Todo;
use MatCaps\Beta\Domain\Exception\InvalidTodoContentException;
use MatCaps\Beta\Domain\UseCase\CreateTodo;

use function beforeEach;
use function PhpUnit\Framework\assertEquals;
use function PhpUnit\Framework\assertInstanceOf;
use function PhpUnit\Framework\assertSame;
use function PhpUnit\Framework\assertNull;

beforeEach(function () {
    $this->todoRepository = new TodosRepository();
});

it(
    "should create a todo instance",
    function () {
        $useCase = new CreateTodo($this->todoRepository);
        $todo = $useCase->execute('Mon premier todo');

        assertInstanceOf(Todo::class, $todo);
        assertSame("Mon premier todo", $todo->getContent());
        assertNull($todo->getDueAt());
    }
);


it(
    'should create a Todo',
    function () {
        $records = $this->todoRepository->getCurrentCount();

        $useCase = new CreateTodo($this->todoRepository);
        $todo = $useCase->execute('Mon premier todo');

        assertInstanceOf(Todo::class, $todo);
        assertEquals($records + 1, $this->todoRepository->getCurrentCount());
        assertEquals($this->todoRepository->findById($todo->getId()), $todo);
    }
);

it(
    'should throw an InvalidTodoContentException',
    function ($todoData) {
        $todoRepository = new TodosRepository();
        $useCase = new CreateTodo($todoRepository);
        $useCase->execute($todoData);
    }
)->with(
    [
        [''],
    ]
)->throws(InvalidTodoContentException::class);
