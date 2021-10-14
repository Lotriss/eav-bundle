<?php

namespace Lotriss\Eav\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeJsonRepository;

/**
 * @ORM\Entity(repositoryClass=EavAttributeJsonRepository::class)
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="json_attribute_id_idx", columns={"attribute_id"}),
 *         @ORM\Index(name="json_entity_id_idx", columns={"entity_id"})
 *     }
 * )
 */
class EavAttributeJson extends AbstractEavValue
{
    /**
     * @ORM\Column(type="json", nullable=true)
     */
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
