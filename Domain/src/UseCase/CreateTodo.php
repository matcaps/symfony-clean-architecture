<?php

namespace MatCaps\Beta\Domain\UseCase;

use Assert\LazyAssertionException;
use DateTimeImmutable;
use MatCaps\Beta\Domain\Entity\Todo;
use MatCaps\Beta\Domain\Exception\InvalidTodoContentException;
use MatCaps\Beta\Domain\Gateway\TodoListGateway;

use function Assert\lazy;

/**
 * Class CreateTodo.
 */
class CreateTodo
{
    /** @var TodoListGateway */
    private TodoListGateway $gateway;

    /**
     * CreateTodo constructor.
     * @param TodoListGateway $gateway
     */
    public function __construct(TodoListGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param $content
     *
     * @return Todo
     * @throws InvalidTodoContentException
     */
    public function execute($content): Todo
    {
        $todo = new Todo($content);

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
