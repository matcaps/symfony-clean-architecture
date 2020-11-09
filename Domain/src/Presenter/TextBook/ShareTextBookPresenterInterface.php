<?php

namespace MatCaps\Beta\Domain\Presenter\TextBook;

use MatCaps\Beta\Domain\Response\TextBook\ShareTextBookResponse;

interface ShareTextBookPresenterInterface
{
    public function present(ShareTextBookResponse $response): void;
}
