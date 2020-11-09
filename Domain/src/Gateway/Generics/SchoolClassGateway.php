<?php

namespace MatCaps\Beta\Domain\Gateway\Generics;

use MatCaps\Beta\Domain\Entity\Generics\SchoolClass;

interface SchoolClassGateway
{
    public function findById(): ?SchoolClass;
}
