<?php

namespace App\Infrastructure\Ports\Secondary;

use function array_fill;
use function array_filter;
use function array_key_first;
use function array_values;
use DateTimeImmutable;
use MatCaps\Beta\Domain\Entity\Todo;
use MatCaps\Beta\Domain\Gateway\TodoListGateway;

/**
 * Class TodosRepository.
 */
class TodosRepository implements TodoListGateway
{
    /** @var array<Todo> */
    private array $repository;

    /**
     * TodosRepository constructor.
     * @param array<Todo> $repository
     */
    public function __construct(array $repository = [])
    {
        $this->repository = $repository;
    }

    /**
     * @return array<Todo>
     */
    public function findAll(): array
    {
        return array_fill(0, 20, new Todo('Todo xxx'));
    }

    /**
     * @param Todo $todo
     */
    public function add(Todo $todo): void
    {
        $this->repository[$todo->getId()] = $todo;
    }

    /**
     * @return int
     */
    public function getCurrentCount(): int
    {
        return count($this->repository);
    }

    /**
     * @param string $id
     * @return Todo|null
     */
    public function findById(string $id): ?Todo
    {
        return $this->repository[$id];
    }

    /**
     * @param array<string,mixed> $pair
     * @return Todo|null
     */
    public function findOneBy(array $pair): ?Todo
    {
        $method = array_key_first($pair);
        $value = $pair[$method];

        return array_values(
            array_filter(
                $this->repository,
                function (Todo $todo) use ($value, $method) {
                    return $todo->$method() === $value;
                }
            )
        )[0] ?? null;
    }

    /**
     * @param array<string,mixed> $pair
     * @return array<Todo>
     */
    public function findBy(array $pair): array
    {
        $method = array_key_first($pair);
        $value = $pair[$method];

        return array_filter(
            $this->repository,
            function (Todo $todo) use ($value, $method) {
                return $todo->$method() === $value;
            }
        );
    }

    /**
     * @param Todo $todo
     */
    public function remove(Todo $todo): void
    {
        unset($this->repository[$todo->getId()]);
    }

    /**
     * @return array<Todo>
     */
    public function findAllDueToday(): array
    {
        return array_filter(
            $this->repository,
            function (Todo $todo) {
                return null !== $todo->getDueAt()
                    && $todo->getDueAt()->format('Y-m-d') === (new DateTimeImmutable())->format('Y-m-d');
            }
        );
    }
}
