<?php

namespace Lotriss\Eav\Service;

use Lotriss\Eav\Entity\EavAttribute;
use Lotriss\Eav\Repository\EavAttributeRepository;

class EavAttributeHandler
{
    private EavAttributeRepository $eavAttributeRepository;

    public function __construct(EavAttributeRepository $eavAttributeRepository)
    {
        $this->eavAttributeRepository = $eavAttributeRepository;
    }

    public function processAttributeInitialization(
        string $code,
        string $label,
        string $entityName,
        string $type,
        string $searchType,
        bool $required,
        bool $unique
    ): EavAttribute {
        $eavAttribute = $this->eavAttributeRepository->getAttributeByCode($code, $entityName);
        if (!$eavAttribute) {
            $eavAttribute = new EavAttribute();
            $this->installAttribute($code, $label, $entityName, $type, $searchType, $required, $unique, $eavAttribute);

            return $eavAttribute;
        }

        $this->updateAttribute($label, $type, $searchType, $required, $unique, $eavAttribute);

        return $eavAttribute;
    }

    protected function installAttribute(
        string $code,
        string $label,
        string $entityName,
        string $type,
        string $searchType,
        bool $required,
        bool $unique,
        EavAttribute $eavAttributeToCreate
    ): void {
        $eavAttributeToCreate
            ->setCode($code)
            ->setLabel($label)
            ->setType($type)
            ->setSearchType($searchType)
            ->setEntityName($entityName)
            ->setIsRequired($required)
            ->setIsUnique($unique);

        $this->eavAttributeRepository->save($eavAttributeToCreate);
    }

    protected function updateAttribute(
        string $label,
        string $type,
        string $searchType,
        bool $required,
        bool $unique,
        EavAttribute $eavAttributeToUpdate
    ): void {
        if ($type !== $eavAttributeToUpdate->getType()) {
            //@TODO cast all values to new type
        }
        $eavAttributeToUpdate
            ->setLabel($label)
            ->setType($type)
            ->setSearchType($searchType)
            ->setIsRequired($required)
            ->setIsUnique($unique);
        $this->eavAttributeRepository->save($eavAttributeToUpdate);
    }
}
