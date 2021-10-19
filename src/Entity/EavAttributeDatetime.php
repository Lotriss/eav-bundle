<?php

declare(strict_types=1);

namespace Lotriss\Eav\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeDatetimeRepository;

#[ORM\Entity(repositoryClass: EavAttributeDatetimeRepository::class)]
#[ORM\Table]
#[
    ORM\Index(columns: ['attribute_id'], name: 'datetime_attribute_id_idx'),
    ORM\Index(columns: ['entity_id'], name: 'datetime_entity_id_idx'),
    ORM\Index(columns: ['value'], name: 'datetime_value_idx')
]
class EavAttributeDatetime extends AbstractEavValue
{
    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE, nullable: true)]
    private ?DateTimeInterface $value;

    public function getValue(): ?DateTimeInterface
    {
        return $this->value;
    }

    public function setValue(DateTimeInterface $value): self
    {
        $this->value = $value;

        return $this;
    }
}
