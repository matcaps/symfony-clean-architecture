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
        $ids = [];
        for ($i = 1; $i < 11; $i++) {
            $todo =  new Todo("Todo message {$i}");
            $repo->add($todo);
            $ids[] = $todo->getId();
        }

        $index = array_rand($ids, 1);
        $value = $ids[$index];

        $todoToDelete = $repo->findById($value);

        $initialCount = $repo->getCurrentCount();
        
        if ($todoToDelete !== null) {
            $repo->remove($todoToDelete);
        }


        assertEquals($initialCount - 1, $repo->getCurrentCount());
    }
);
