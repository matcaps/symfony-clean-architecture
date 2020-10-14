<?php

namespace MatCaps\Beta\Domain\Tests;

use App\Infrastructure\Ports\Secondary\TodosRepository;
use MatCaps\Beta\Domain\Entity\Todo;

use function array_rand;
use function PHPUnit\Framework\assertEquals;
use function it;

it(
    "should be possible to delete a todo",
    function () {
        $repo = new TodosRepository();
        for ($i = 1; $i < 11; $i++) {
            $todo =  new Todo("Todo message {$i}");
            $repo->add($todo);
            $ids[] = $todo->getId();
        }

        $index = array_rand($ids, 1);
        $value = $ids[$index];

        $initialCount = $repo->getCurrentCount();
        $repo->remove($value);

        assertEquals($initialCount - 1, $repo->getCurrentCount());
    }
);
