<?php

namespace MatCaps\Beta\Domain\Entity\Generics;

class SchoolClass
{
    private ?string $id = null;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id ?? null;
    }
}
