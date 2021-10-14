<?php

namespace Lotriss\Eav\Service;

use Lotriss\Eav\Entity\EavAttribute;
use Lotriss\Eav\Repository\EavAttributeRepository;
use Lotriss\Eav\Service\Exception\UnknownEavAttributeException;

class EavConfig
{
    private array $eavConfigData;
    private array $eavLoadedData = [];
    private EavAttributeRepository $eavAttributeRepository;

    public function __construct(
        EavAttributeRepository $eavAttributeRepository,
        array $eavConfigData = []
    ) {
        $this->eavAttributeRepository = $eavAttributeRepository;
        $this->eavConfigData = $eavConfigData;
    }

    /**
     * @param string $entityName
     *
     * @return EavAttribute[]
     */
    public function getEavSettingsForEntity(string $entityName): array
    {
        if (!isset($this->eavLoadedData[$entityName])) {
            $this->eavLoadedData[$entityName] = [];
            $attributesForEntity = $this->eavAttributeRepository->getAttributesByEntityName($entityName);
            foreach ($attributesForEntity as $attribute) {
                $this->eavLoadedData[$entityName][$attribute->getCode()] = $attribute;
            }
        }

        return $this->eavLoadedData[$entityName];
    }

    public function getAttributeSettingsForEntity(string $entityName, string $code): ?EavAttribute
    {
        $eavEntityData = $this->getEavSettingsForEntity($entityName);
        if (!isset($eavEntityData[$code])) {
            throw new UnknownEavAttributeException(
                vsprintf(
                    'Unknown attribute [%s] in entity [%s], probably there is a typo in attribute name.',
                    [$code, $entityName]
                )
            );
        }

        return $eavEntityData[$code];
    }

    public function getEavConfig(): array
    {
        return $this->eavConfigData;
    }
}
