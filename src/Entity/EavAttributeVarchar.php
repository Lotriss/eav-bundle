<?php

namespace Lotriss\Eav\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeVarcharRepository;

/**
 * @ORM\Entity(repositoryClass=EavAttributeVarcharRepository::class)
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="varchar_attribute_id_idx", columns={"attribute_id"}),
 *         @ORM\Index(name="varchar_entity_id_idx", columns={"entity_id"}),
 *         @ORM\Index(name="varchar_value_idx", columns={"value"})
 *     }
 * )
 */
class EavAttributeVarchar extends AbstractEavValue
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
