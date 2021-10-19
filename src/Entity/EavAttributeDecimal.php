<?php

declare(strict_types=1);

namespace Lotriss\Eav\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeDecimalRepository;

#[ORM\Entity(repositoryClass: EavAttributeDecimalRepository::class)]
#[ORM\Table]
#[
    ORM\Index(columns: ['attribute_id'], name: 'decimal_attribute_id_idx'),
    ORM\Index(columns: ['entity_id'], name: 'decimal_entity_id_idx'),
    ORM\Index(columns: ['value'], name: 'decimal_value_idx')
]
class EavAttributeDecimal extends AbstractEavValue
{
    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 4, nullable: true)]
    private ?string $value;

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
