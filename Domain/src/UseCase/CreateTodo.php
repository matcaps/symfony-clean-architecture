<?php

namespace MatCaps\Beta\Domain\UseCase;

use function Assert\lazy;
use Assert\LazyAssertionException;
use DateTimeImmutable;
use MatCaps\Beta\Domain\Entity\Todo;
use MatCaps\Beta\Domain\Exception\InvalidTodoContentException;
use MatCaps\Beta\Domain\Gateway\TodoListGateway;

/**
 * Class CreateTodo.
 */
class CreateTodo
{
    /** @var TodoListGateway */
    private TodoListGateway $gateway;

    /**
     * CreateTodo constructor.
     */
    public function __construct(TodoListGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param $content
     *
     * @throws InvalidTodoContentException
     */
    public function execute($content): Todo
    {
        $todo = new Todo($content, new DateTimeImmutable());

        try {
            $this->validate($todo);
        } catch (LazyAssertionException $e) {
            throw new InvalidTodoContentException('Le contenu de la tâche ne peut pas être vide.');
        }

        $this->gateway->add($todo);

        return $todo;
    }

    protected function validate(Todo $todo)
    {
        lazy()->that($todo->getContent())->notBlank()
            ->verifyNow();
    }
}
