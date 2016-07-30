<?php

namespace Caelaris\Arcade\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class InitCommand
 */
class InitCommand extends Command
{
    const OPTION_PATH = 'path';
    const SHORT_OPTION_PATH = 'p';
    
    /**
     * Configure the init command
     */
    protected function configure()
    {
        $this->setName('init')
            ->setDescription('Initialize a new Symfony Console application')
            ->addOption(self::OPTION_PATH, self::SHORT_OPTION_PATH, InputArgument::REQUIRED, 'Path in which to initialize the new Console application');
    }
}