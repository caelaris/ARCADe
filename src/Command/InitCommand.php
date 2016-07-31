<?php

namespace Caelaris\Arcade\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Class InitCommand
 */
final class InitCommand extends Command
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
            ->addOption(self::OPTION_PATH, self::SHORT_OPTION_PATH, InputOption::VALUE_REQUIRED, 'Path in which to initialize the new Console application');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }

    /**
     * Interact with the user
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>This command will help you to quickly setup a new console application</info>');
        $path = $this->validatePath($input, $output, $input->getOption(self::OPTION_PATH));

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param $path
     * @return
     */
    private function validatePath(InputInterface $input, OutputInterface $output, $path)
    {
        $path = realpath($path);

        $confirmPathQuestion = new ConfirmationQuestion('Current install path: <comment>'
            . $path 
            . '</comment>. '
            . 'Confirm? [Y/n]: '
            , true
        );
        
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        if (!$helper->ask($input, $output, $confirmPathQuestion)) {
            $newPathQuestion = new Question('Please specify the path where the new application should be created: ' . PHP_EOL);
            $newPath = $helper->ask($input, $output, $newPathQuestion);
            $path = $this->validatePath($input, $output, $newPath);
        }

        return $path;
    }
}