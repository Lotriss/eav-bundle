<?php

declare(strict_types=1);

namespace Lotriss\Eav\Service;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EavAttributeInstaller
{
    private EavAttributeHandler $attributeHandler;

    private EavConfig $eavConfig;

    private bool $inCli = false;

    private ?OutputInterface $output;

    private ?InputInterface $input;

    public function __construct(EavAttributeHandler $attributeHandler, EavConfig $eavConfig)
    {
        $this->attributeHandler = $attributeHandler;
        $this->eavConfig = $eavConfig;
    }

    public function passIO(InputInterface $input, OutputInterface $output): self
    {
        $this->output = $output;
        $this->input = $input;
        $this->inCli = true;

        return $this;
    }

    public function installFromConfig(): bool
    {
        $eavAttributesConfig = $this->eavConfig->getEavConfig();
        foreach ($eavAttributesConfig as $entityEavConfig) {
            $this->attributeHandler->processAttributeInitialization(
                $entityEavConfig['code'],
                $entityEavConfig['label'],
                $entityEavConfig['entity_class'],
                $entityEavConfig['type'],
                $entityEavConfig['search_type'] ?? 'none',
                $entityEavConfig['required'] ?? false,
                $entityEavConfig['unique'] ?? false,
            );
        }

        return true;
    }
}
