<?php

declare(strict_types=1);

namespace Lotriss\Eav\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeVarcharRepository;

#[ORM\Entity(repositoryClass: EavAttributeVarcharRepository::class)]
#[ORM\Table]
#[
    ORM\Index(columns: ['attribute_id'], name: 'varchar_attribute_id_idx'),
    ORM\Index(columns: ['entity_id'], name: 'varchar_entity_id_idx'),
    ORM\Index(columns: ['value'], name: 'varchar_value_idx')
]
class EavAttributeVarchar extends AbstractEavValue
{
    #[ORM\Column(type: Types::STRING, nullable: true)]
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
