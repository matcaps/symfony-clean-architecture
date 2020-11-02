<?php

namespace MatCaps\Beta\Domain\UseCase\TextBook;

use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;
use MatCaps\Beta\Domain\Entity\TextBook\SharedTextBook;
use MatCaps\Beta\Domain\Gateway\Generics\SchoolClassGateway;
use MatCaps\Beta\Domain\Gateway\TextBook\SharedTextBookGateway;
use MatCaps\Beta\Domain\Gateway\TextBook\TextBookGateway;
use MatCaps\Beta\Domain\Presenter\TextBook\ShareTextBookPresenterInterface;
use MatCaps\Beta\Domain\Request\TextBook\ShareTextBookRequest;
use MatCaps\Beta\Domain\Response\TextBook\ShareTextBookResponse;

class ShareTextBook
{
    private ShareTextBookRequest $request;
    private SharedTextBookGateway $textBookGateway;
    private SchoolClass $schoolClass;
    private ShareTextBookPresenterInterface $presenter;

    public function __construct(
        ShareTextBookRequest $request,
        SharedTextBookGateway $textBookGateway,
        ShareTextBookPresenterInterface $presenter
    ) {
        $this->request = $request;
        $this->textBookGateway = $textBookGateway;
        $this->presenter = $presenter;
    }

    public function execute(): void
    {
        $sharedTextBook = new SharedTextBook($this->request->getTextBook(), $this->request->getSchoolClass());

        $isShared = $this->textBookGateway->share($sharedTextBook);
        if ($isShared) {
            $this->request->getTextBook()->markAsShared();
        }
        $sharedTextBookEntries = $this->textBookGateway->findAllSharedWith($this->request->getSchoolClass());

        $this->presenter->present(new ShareTextBookResponse($sharedTextBookEntries));
    }
}
