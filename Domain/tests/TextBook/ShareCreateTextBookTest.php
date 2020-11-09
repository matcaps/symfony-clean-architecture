<?php

namespace MatCaps\Beta\Domain\Tests\TextBook;

use DateInterval;
use DateTimeImmutable;
use InvalidArgumentException;
use LogicException;
use MatCaps\Beta\Domain\Entity\Generics\Course;
use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\Textbook;
use MatCaps\Beta\Domain\Exception\TextBook\InvalidTextBookException;
use MatCaps\Beta\Domain\Presenter\TextBook\ShareTextBookPresenterInterface;
use MatCaps\Beta\Domain\Request\TextBook\ShareTextBookRequest;
use MatCaps\Beta\Domain\Response\TextBook\ShareTextBookResponse;
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
class ShareCreateTextBookTest extends TestCase
{
    private TextBookRepository $textBookRepository;
    private Textbook $textBook;
    private SchoolClass $schoolClass;
    private UuidInterface $uuid;
    private ShareTextBookPresenterInterface $presenter;

    /**
     * @throws InvalidTextBookException
     */
    protected function setUp(): void
    {
        $this->uuid = Uuid::uuid4();
        $this->textBookRepository = new TextBookRepository();
        $this->schoolClass = new SchoolClass();
        $this->presenter = new class implements ShareTextBookPresenterInterface {
            public ShareTextBookResponse $response;

            public function present(ShareTextBookResponse $response): void
            {
                $this->response = $response;
            }
        };
        $this->textBook = new Textbook(
            $this->uuid->toString(),
            "this is content to share to all student",
            (new DateTimeImmutable())->add(new DateInterval("P1W")),
            new Course(),
            $this->schoolClass
        );

        $this->textBookRepository->add($this->textBook);
    }

    public function testShareSuccessfully(): void
    {
        $request = new ShareTextBookRequest($this->textBook);
        $useCase = new ShareTextBook(
            $request,
            $this->textBookRepository,
            $this->presenter
        );

        $useCase();

        /** @var ShareTextBookResponse $response */
        $response = $this->presenter->response;

        self::assertInstanceOf(ShareTextBookResponse::class, $response);
        self::assertCount(1, $response->getEntries());
        self::assertInstanceOf(Textbook::class, $response->getEntries()[0]);
    }

    public function testShareAlreadySharedTextBook(): void
    {
        $this->expectException(LogicException::class);

        //pre-init shared Repository with textbook to provoque an exception at usecase run
        $this->textBook->share();
        $this->textBookRepository->update($this->textBook);

        $request = new ShareTextBookRequest($this->textBook);
        $useCase = new ShareTextBook(
            $request,
            $this->textBookRepository,
            $this->presenter
        );

        $useCase();
    }
}
