<?php

use App\Infrastructure\Ports\Secondary\TodosRepository;
use MatCaps\Beta\Domain\Entity\Todo;

use function PHPUnit\Framework\assertCount;

it(
    "should present a list of 10 todos which should be closed today",
    function () {
        $repo1 = new TodosRepository();

        for ($i = 1; $i < 11; $i++) {
            $todo = new Todo("Todo message {$i}", new DateTimeImmutable());
            $repo1->add($todo);
        }

        $todos = $repo1->findAllDueToday();
        assertCount(10, $todos);
    }
);

it(
    "should not find todos which have to be closed today",
    function () {
        $repo = new TodosRepository();

        for ($i = 1; $i < 11; $i++) {
            $todo = new Todo("Todo message {$i}", (new DateTimeImmutable())->add(new DateInterval("P2D")));
            $repo->add($todo);
        }
        $todosNotDue = $repo->findAllDueToday();

        assertCount(0, $todosNotDue);
    }
);

//it(
//    "should not find todos which have to be closed today",
//    function (TodosRepository $repo) {
//        $todosNotDue = $repo->findAllDueToday();
//        assertCount(0, $todosNotDue);
//    }
//)->with([todoFromAfterTodayRepositoryProvider()]);


//function todoFromAfterTodayRepositoryProvider()
//{
//    $repo = new TodosRepository();
//
//    for ($i = 1; $i < 11; $i++) {
//        $todo = new Todo("Todo message {$i}", (new DateTimeImmutable())->add(new DateInterval("P2D")));
//        $repo->add($todo);
//    }
//
//    return $repo;
//}
