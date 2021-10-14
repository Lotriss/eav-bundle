<?php

namespace Lotriss\Eav\Tests;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Lotriss\Eav\LotrissEavBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class LotrissEavTestingKernel extends Kernel
{
    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new DoctrineBundle(),
            new LotrissEavBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {

    }
}