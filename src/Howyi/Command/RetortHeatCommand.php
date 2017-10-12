<?php

namespace Howyi\Command;

use Howyi\Retort;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RetortHeatCommand extends Command
{
    protected function configure()
    {
        $this->setName('heat');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Retort::heat();
    }
}
