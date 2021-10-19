<?php

namespace Lotriss\Eav\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BundleKernelTestCase extends KernelTestCase
{
    protected ?EntityManagerInterface $entityManager;

    protected static function getKernelClass()
    {
        return LotrissEavTestingKernel::class;
    }

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel(['debug' => false]);
        $this->entityManager = static::$kernel->getContainer()->get('doctrine')->getManager();
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($metadata);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->dropDatabase();
        $this->entityManager->close();
        $this->entityManager = null;
    }

}