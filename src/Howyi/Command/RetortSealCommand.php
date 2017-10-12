<?php

namespace Howyi\Command;

use Howyi\Retort;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RetortSealCommand extends Command
{
    protected function configure()
    {
        $this->setName('seal');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Retort::seal();
    }
}
