<?php

namespace MatCaps\Beta\Domain\Tests\TextBook;

use App\Infrastructure\Ports\Secondary\TextBook\SharedTextBookRepository;
use DateInterval;
use DateTimeImmutable;
use MatCaps\Beta\Domain\Entity\Generics\Course;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Exception\InvalidTextBookException;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Request\TextBook\ShareTextBookRequest;
use MatCaps\Beta\Domain\Tests\TextBook\Repository\TextBookRepository;
use MatCaps\Beta\Domain\UseCase\TextBook\ShareTextBook;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Share Text book feature:
 *
 * Dans ce cas d'utilisation un enseignant a déjà enregistré une entrée dans le cahier de textes.
 * A ce stade les élèves n'en ont pas connaissance et l'enseignant peut encore le modifier.
 * L'enseignant doit donc volontairement le partager avec les élèves.
 *
 * Class ShareTextBookTest
 * @package MatCaps\Beta\Domain\Tests\TextBook
 */
class ShareTextBookTest extends TestCase
{
    private TextBookRepository $textBookRepository;
    private Textbook $textBook;
    private SchoolClass $schoolClass;
    private SharedTextBookRepository $sharedTextBookRepository;
    private UuidInterface $uuid;

    /**
     *
     * @throws InvalidTextBookException
     */
    protected function setUp(): void
    {
        $this->textBookRepository = new TextBookRepository();
        $this->sharedTextBookRepository = new SharedTextBookRepository();
        $this->schoolClass = new SchoolClass();

        $this->textBook = new Textbook(
            $this->uuid->toString(),
            "this is content to share to all student",
            (new DateTimeImmutable())->add(new DateInterval("P1W")),
            new Course(),
            $this->schoolClass
        );

        $this->textBookRepository->add($this->textBook);
    }

    public function testShareSuccefully(): void
    {
        $request = new ShareTextBookRequest($this->textBook->getId(), $this->schoolClass->getId());
        $useCase = new ShareTextBook($request, $this->textBookRepository, $this->sharedTextBookRepository);

        $useCase->execute();
    }
}
