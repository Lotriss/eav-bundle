<?php

namespace Lotriss\Eav\Service;

class EavEntityHandlerFactory
{
    protected array $loadedHandlers = [];

    protected EavConfig $eavConfig;

    private EavHelper $eavHelper;

    public function __construct(EavConfig $eavConfig, EavHelper $eavHelper)
    {
        $this->eavConfig = $eavConfig;
        $this->eavHelper = $eavHelper;
    }

    public function get(string $entityName): EavEntityHandlerFactory
    {
        if (!isset($this->loadedHandlers[$entityName])) {
            $this->loadedHandlers[$entityName] = new EavEntityHandler($entityName, $this->eavConfig, $this->eavHelper);
        }

        return $this->loadedHandlers[$entityName];
    }
}
