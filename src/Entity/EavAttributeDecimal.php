<?php

namespace Lotriss\Eav\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeDecimalRepository;

/**
 * @ORM\Entity(repositoryClass=EavAttributeDecimalRepository::class)
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="decimal_attribute_id_idx", columns={"attribute_id"}),
 *         @ORM\Index(name="decimal_entity_id_idx", columns={"entity_id"}),
 *         @ORM\Index(name="decimal_value_idx", columns={"value"})
 *     }
 * )
 */
class EavAttributeDecimal extends AbstractEavValue
{
    /**
     * @ORM\Column(type="decimal", precision=12, scale=4, nullable=true)
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
