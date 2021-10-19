<?php

namespace Lotriss\Eav\Tests\Command;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Lotriss\Eav\Repository\EavAttributeRepository;
use Lotriss\Eav\Service\EavAttributeInstaller;
use Lotriss\Eav\Tests\BundleKernelTestCase;
use Lotriss\Eav\Tests\LotrissEavTestingKernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class InitEavAttributesTest extends BundleKernelTestCase
{
    public function testInit()
    {
        $container = self::getContainer();
        /** @var EavAttributeRepository $eavRepository */
        $eavRepository = $container->get(EavAttributeRepository::class);
        $eavRepository->createQueryBuilder('eav')->delete()->getQuery()->execute();

        $application = new Application(static::$kernel);
        $command = $application->find('lotriss:eav:update');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $this->assertEquals(1, $commandTester->getStatusCode());
    }

    public function testUpdate()
    {
        $container = self::getContainer();
        /** @var EavAttributeInstaller $attributeInstaller */
        $attributeInstaller = $container->get(EavAttributeInstaller::class);
        $attributeInstaller->installFromConfig();

        $application = new Application(static::$kernel);
        $command = $application->find('lotriss:eav:update');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $this->assertEquals(1, $commandTester->getStatusCode());
    }
}
