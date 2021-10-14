<?php

namespace Lotriss\Eav\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeIntRepository;

/**
 * @ORM\Entity(repositoryClass=EavAttributeIntRepository::class)
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="int_attribute_id_idx", columns={"attribute_id"}),
 *         @ORM\Index(name="int_entity_id_idx", columns={"entity_id"}),
 *         @ORM\Index(name="int_value_idx", columns={"value"})
 *     }
 * )
 */
class EavAttributeInt extends AbstractEavValue
{
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
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
