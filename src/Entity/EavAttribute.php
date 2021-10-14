<?php

namespace Lotriss\Eav\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lotriss\Eav\Repository\EavAttributeRepository;

/**
 * @ORM\Entity(repositoryClass=EavAttributeRepository::class)
 * @ORM\Table(
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="code_entity_name_uidx", columns={"code", "entity_name"})
 *     },
 *     indexes={
 *         @ORM\Index(name="code_entity_name_idx", columns={"code", "entity_name"}),
 *         @ORM\Index(name="type_idx", columns={"type"})
 *     }
 * )
 */
class EavAttribute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isRequired;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isUnique;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private ?array $availableOptions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $searchType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $entityName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isRequired(): ?bool
    {
        return $this->isRequired;
    }

    public function setIsRequired(bool $isRequired): self
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    public function isUnique(): ?bool
    {
        return $this->isUnique;
    }

    public function setIsUnique(bool $isUnique): self
    {
        $this->isUnique = $isUnique;

        return $this;
    }

    public function getAvailableOptions(): ?array
    {
        return $this->availableOptions;
    }

    public function setAvailableOptions(?array $availableOptions): self
    {
        $this->availableOptions = $availableOptions;

        return $this;
    }

    public function getSearchType(): ?string
    {
        return $this->searchType;
    }

    public function setSearchType(string $searchType): self
    {
        $this->searchType = $searchType;

        return $this;
    }

    public function getEntityName(): ?string
    {
        return $this->entityName;
    }

    public function setEntityName(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

    public function getSelectCode(): string
    {
        return vsprintf('%s_%s', [$this->getCode(), $this->getId()]);
    }
}
