<?php

declare(strict_types=1);

namespace Lotriss\Eav\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeTextRepository;

#[ORM\Entity(repositoryClass: EavAttributeTextRepository::class)]
#[ORM\Table]
#[
    ORM\Index(columns: ['attribute_id'], name: 'text_attribute_id_idx'),
    ORM\Index(columns: ['entity_id'], name: 'text_entity_id_idx'),
]
class EavAttributeText extends AbstractEavValue
{
    #[ORM\Column(type: Types::TEXT, nullable: true)]
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
