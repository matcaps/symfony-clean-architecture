<?php

namespace MatCaps\Beta\Domain\Gateway;

use MatCaps\Beta\Domain\Entity\Todo;

/**
 * Interface TodoListGateway
 * @package MatCaps\Beta\Domain\Gateway
 */
interface TodoListGateway
{
    /**
     * @return array<Todo>
     */
    public function findAll(): array;

    /**
     * @param Todo $todo
     */
    public function add(Todo $todo): void;

    /**
     * @return int
     */
    public function getCurrentCount(): int;

    /**
     * @param array<string,mixed> $pairs
     * @return Todo|null
     */
    public function findOneBy(array $pairs): ?Todo;

    /**
     * @param array<string,mixed> $pair
     * @return array<Todo>
     */
    public function findBy(array $pair): array;

    /**
     * @param Todo $todo
     */
    public function remove(Todo $todo): void;

    /**
     * @return array<Todo>
     */
    public function findAllDueToday(): array;
}
