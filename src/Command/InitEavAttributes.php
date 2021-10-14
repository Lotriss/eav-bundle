<?php

namespace Lotriss\Eav\Command;

use Lotriss\Eav\Service\EavAttributeInstaller;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitEavAttributes extends Command
{
    protected static $defaultName = 'lotriss:eav:update';

    private EavAttributeInstaller $eavAttributeInstaller;

    public function __construct(EavAttributeInstaller $eavAttributeInstaller)
    {
        parent::__construct();
        $this->eavAttributeInstaller = $eavAttributeInstaller;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->eavAttributeInstaller->passIO($input, $output)->installFromConfig();

        return 1;
    }
}
