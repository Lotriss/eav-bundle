<?php

declare(strict_types=1);

namespace Lotriss\Eav\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeIntRepository;

#[ORM\Entity(repositoryClass: EavAttributeIntRepository::class)]
#[ORM\Table]
#[
    ORM\Index(columns: ['attribute_id'], name: 'int_attribute_id_idx'),
    ORM\Index(columns: ['entity_id'], name: 'int_entity_id_idx'),
    ORM\Index(columns: ['value'], name: 'int_value_idx')
]
class EavAttributeInt extends AbstractEavValue
{
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $value;

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }
}
