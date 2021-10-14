<?php

namespace Lotriss\Eav\Entity;

interface EavEntityInterface
{
    public function getId(): ?int;

    public function getSlug(): ?string;

    public function setSlug(string $slug): self;
}
