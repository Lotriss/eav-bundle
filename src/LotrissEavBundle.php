<?php

declare(strict_types=1);

namespace Lotriss\Eav;

use Lotriss\Eav\DependencyInjection\LotrissEavExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LotrissEavBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new LotrissEavExtension();
        }

        return $this->extension;
    }
}
