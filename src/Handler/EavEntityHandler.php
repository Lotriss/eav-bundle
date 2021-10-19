<?php

declare(strict_types=1);

namespace Lotriss\Eav\Handler;

use Lotriss\Eav\Entity\EavAttribute;
use Lotriss\Eav\Entity\EavEntityInterface;
use Lotriss\Eav\Service\EavConfig;
use Lotriss\Eav\Service\EavHelper;
use Lotriss\Eav\Service\Exception\AttributeValueRequiredException;
use Lotriss\Eav\Service\Exception\ValueNotUniqueException;

class EavEntityHandler
{
    protected array $errors = [];
    protected string $entityName;
    protected EavConfig $eavConfig;
    protected EavHelper $eavHelper;

    public function __construct(
        string $entityName,
        EavConfig $eavConfig,
        EavHelper $eavHelper
    ) {
        $this->entityName = $entityName;
        $this->eavConfig = $eavConfig;
        $this->eavHelper = $eavHelper;
    }

    public function validateEntity(EavEntityInterface $eavEntity, array $attributes): bool
    {
        $this->errors = [];
        $mappedAttributes = $this->processAttributeMapping($attributes);
        foreach ($mappedAttributes as $code => $attributeValueMapped) {
            try {
                $this->validateAttribute($code, $eavEntity, $attributeValueMapped);
            } catch (ValueNotUniqueException $exception) {
                $this->errors[] = sprintf('Value [%s] for [%s] is not unique', $attributeValueMapped, $code);
            } catch (AttributeValueRequiredException $exception) {
                $this->errors[] = sprintf('Attribute [%s] is required', $code);
            }
        }

        return !empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    protected function validateAttribute(string $code, EavEntityInterface $eavEntity, mixed $value): bool
    {
        $eavConfig = $this->eavConfig->getAttributeSettingsForEntity($this->entityName, $code);
        if ($eavConfig->isRequired() && is_null($value)) {
            throw new AttributeValueRequiredException();
        }

        if ($eavConfig->isUnique()) {
            if (!$this->checkUniqueness($eavConfig, $eavEntity, $value)) {
                throw new ValueNotUniqueException();
            }
        }

        return false;
    }

    protected function checkUniqueness(EavAttribute $eavAttribute, EavEntityInterface $eavEntity, mixed $value): bool
    {
        return true;
    }

    protected function processAttributeMapping(array $attributes): array
    {
        $attributesDataMap = [];
        $config = $this->eavConfig->getEavSettingsForEntity($this->entityName);
        foreach ($config as $code => $eavAttribute) {
            $attributesDataMap[$code] = $attributes[$code] ?? null;
        }

        return $attributesDataMap;
    }
}
