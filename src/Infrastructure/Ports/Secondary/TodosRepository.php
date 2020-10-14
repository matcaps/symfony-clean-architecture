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
    /** @var array */
    private array $repository;

    /**
     * TodosRepository constructor.
     * @param array $repository
     */
    public function __construct(array $repository = [])
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return array_fill(0, 20, new Todo('Todo xxx'));
    }

    public function add(Todo $todo)
    {
        $this->repository[$todo->getId()] = $todo;
    }

    /**
     * @return int
     */
    public function getCurrentCount()
    {
        return count($this->repository);
    }

    public function findById(string $id): ?Todo
    {
        return $this->repository[$id];
    }

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

    public function remove($id): void
    {
        unset($this->repository[$id]);
    }

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
