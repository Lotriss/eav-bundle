<?php

declare(strict_types=1);

namespace Lotriss\Eav\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeJsonRepository;

#[ORM\Entity(repositoryClass: EavAttributeJsonRepository::class)]
#[ORM\Table]
#[
    ORM\Index(columns: ['attribute_id'], name: 'json_attribute_id_idx'),
    ORM\Index(columns: ['entity_id'], name: 'json_entity_id_idx'),
]
class EavAttributeJson extends AbstractEavValue
{
    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $value;

    public function getValue(): ?array
    {
        return $this->value;
    }

    public function setValue(array $value): self
    {
        $this->value = $value;

        return $this;
    }
}
