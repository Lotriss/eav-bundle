<?php

namespace Lotriss\Eav\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeDatetimeRepository;

/**
 * @ORM\Entity(repositoryClass=EavAttributeDatetimeRepository::class)
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="datetime_attribute_id_idx", columns={"attribute_id"}),
 *         @ORM\Index(name="datetime_entity_id_idx", columns={"entity_id"}),
 *         @ORM\Index(name="datetime_value_idx", columns={"value"})
 *     }
 * )
 */
class EavAttributeDatetime extends AbstractEavValue
{
    /**
     * @ORM\Column(type="datetimetz", precision=12, scale=4, nullable=true)
     */
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
