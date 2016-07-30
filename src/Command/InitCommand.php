<?php

namespace Caelaris\Arcade\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

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

        $path = $this->validatePath($input, $output);
//        /** @var QuestionHelper $helper */
//        $helper = $this->getHelper('question');
//        $path = $input->getOption(self::OPTION_PATH);
//        if (null !== $path) {
//            $path = realpath($path);
//            if (!$helper->ask($input, $output, $question)) {
//                $newPathQuestion = new Question('Where would you like your new application to be created: ');
//                $path = $helper->ask($input, $output, $newPathQuestion);
//                echo realpath($path);
//            }
//        }
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param null $confirmationQuestion
     */
    public function validatePath(InputInterface $input, OutputInterface $output, $confirmationQuestion = null)
    {
        $path = $input->getOption(self::OPTION_PATH);

        if (null === $path) {
            return realpath('.');
        }

        if (null === $confirmationQuestion) {
            $confirmationQuestion = new ConfirmationQuestion('Your new application will be created at <comment>' . $path . '</comment>.' . PHP_EOL . 'Do you want to change the installation path [y/N]: ', false);
        }
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');
        $helper->ask($input, $output, $confirmationQuestion);
    }
}