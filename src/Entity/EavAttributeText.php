<?php

namespace Lotriss\Eav\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeTextRepository;

/**
 * @ORM\Entity(repositoryClass=EavAttributeTextRepository::class)
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="text_attribute_id_idx", columns={"attribute_id"}),
 *         @ORM\Index(name="text_entity_id_idx", columns={"entity_id"})
 *     }
 * )
 */
class EavAttributeText extends AbstractEavValue
{
    /**
     * @ORM\Column(type="string", length=65535, nullable=true)
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
