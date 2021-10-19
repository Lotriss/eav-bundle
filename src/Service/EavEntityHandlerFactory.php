<?php

declare(strict_types=1);

namespace Lotriss\Eav\Service;

use Lotriss\Eav\Handler\EavEntityHandler;

class EavEntityHandlerFactory
{
    /**
     * @var array<string, EavEntityHandler>
     */
    protected array $loadedHandlers = [];

    protected EavConfig $eavConfig;

    private EavHelper $eavHelper;

    public function __construct(EavConfig $eavConfig, EavHelper $eavHelper)
    {
        $this->eavConfig = $eavConfig;
        $this->eavHelper = $eavHelper;
    }

    public function get(string $entityName): EavEntityHandler
    {
        if (!isset($this->loadedHandlers[$entityName])) {
            $this->loadedHandlers[$entityName] = new EavEntityHandler($entityName, $this->eavConfig, $this->eavHelper);
        }

        return $this->loadedHandlers[$entityName];
    }
}
