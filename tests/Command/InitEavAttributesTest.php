<?php

namespace Lotriss\Eav\Tests\Command;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Lotriss\Eav\Repository\EavAttributeRepository;
use Lotriss\Eav\Service\EavAttributeInstaller;
use Lotriss\Eav\Tests\LotrissEavTestingKernel;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class InitEavAttributesTest extends TestCase
{
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        $kernel = new LotrissEavTestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();
        // @var EntityManagerInterface $eavRepository
        $this->entityManager = $container->get(EntityManagerInterface::class);
        $this->entityManager->beginTransaction();
        $this->entityManager->getConnection()->setAutoCommit(false);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        if ($this->entityManager->getConnection()->isTransactionActive()) {
            $this->entityManager->rollback();
        }
    }

    public function testInit()
    {
        $kernel = new LotrissEavTestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();
        /** @var EavAttributeRepository $eavRepository */
        $eavRepository = $container->get(EavAttributeRepository::class);
        $eavRepository->createQueryBuilder('eav')->delete()->getQuery()->execute();

        $kernel = new LotrissEavTestingKernel('test', true);
        $kernel->boot();
        $application = new Application($kernel);
        $command = $application->find('lotriss:eav:update');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $this->assertEquals(1, $commandTester->getStatusCode());
    }

    public function testUpdate()
    {
        $kernel = new LotrissEavTestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();
        /** @var EavAttributeInstaller $attributeInstaller */
        $attributeInstaller = $container->get(EavAttributeInstaller::class);
        $attributeInstaller->installFromConfig();

        $kernel = new LotrissEavTestingKernel('test', true);
        $kernel->boot();
        $application = new Application($kernel);
        $command = $application->find('lotriss:eav:update');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $this->assertEquals(1, $commandTester->getStatusCode());
    }
}
