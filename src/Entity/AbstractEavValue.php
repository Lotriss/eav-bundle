<?php

declare(strict_types=1);

namespace Lotriss\Eav\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass()]
abstract class AbstractEavValue
{
    #[Orm\Id, ORM\Column(type: Types::INTEGER), ORM\GeneratedValue(strategy: 'IDENTITY')]
    protected ?int $id;

    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $attributeId;

    #[ORM\Column(type: Types::INTEGER)]
    protected ?int $entityId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttributeId(): ?int
    {
        return $this->attributeId;
    }

    public function setAttributeId(int $attributeId): self
    {
        $this->attributeId = $attributeId;

        return $this;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): self
    {
        $this->entityId = $entityId;

        return $this;
    }
}
