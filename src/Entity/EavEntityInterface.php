<?php

declare(strict_types=1);

namespace Lotriss\Eav\Entity;

interface EavEntityInterface
{
    public function getId(): ?int;

    public function getSlug(): ?string;

    public function setSlug(string $slug): self;
}
