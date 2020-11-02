<?php

namespace App\Infrastructure\Ports\Secondary\TextBook;

use InvalidArgumentException;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\SharedTextBook;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Gateway\TextBook\SharedTextBookGateway;

use function array_fill;
use function array_filter;
use function array_push;

class SharedTextBookRepository implements SharedTextBookGateway
{
    /** @var array */
    private array $items = [];

    public function share(SharedTextbook $sharedTextbook): bool
    {
        try {
            if (isset($this->items[$sharedTextbook->getSchoolClass()->getId()])) {
                throw new InvalidArgumentException("Textbook is already shared");
            }
            $this->items[$sharedTextbook->getSchoolClass()->getId()][] = $sharedTextbook->getTextbook();
            return true;
        } catch (InvalidArgumentException $exception) {
            throw $exception;
        }
    }

    /**
     * @param SchoolClass $schoolClass
     * @return array<Textbook>
     */
    public function findAllSharedWith(SchoolClass $schoolClass): array
    {
        return $this->items[$schoolClass->getId()] ?? [];
    }
}
