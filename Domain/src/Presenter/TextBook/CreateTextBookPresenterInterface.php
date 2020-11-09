<?php

namespace MatCaps\Beta\Domain\Presenter\TextBook;

use MatCaps\Beta\Domain\Response\TextBook\AddTextBookResponse;

interface CreateTextBookPresenterInterface
{
    /**
     * @param AddTextBookResponse $response
     * @return mixed
     */
    public function present(AddTextBookResponse $response);
}
