<?php
use Caelaris\Arcade\Command\InitCommand;

/**
 * Class InitCommandTest
 */
class InitCommandTest extends PHPUnit_Framework_TestCase
{
    const CLASS_NAME_SYMFONY_INPUT_OPTION = '\Symfony\Component\Console\Input\InputOption';
    const CLASS_NAME_SYMFONY_INPUT_INTERFACE = '\Symfony\Component\Console\Input\InputInterface';
    const CLASS_NAME_SYMFONY_OUTPUT_INTERFACE = '\Symfony\Component\Console\Output\OutputInterface';
    const CLASS_NAME_SYMFONY_HELPER_SET = '\Symfony\Component\Console\Helper\HelperSet';
    const CLASS_NAME_SYMFONY_QUESTION_HELPER = '\Symfony\Component\Console\Helper\QuestionHelper';
    const CLASS_NAME_CONFIRMATION_QUESTION = '\Symfony\Component\Console\Question\ConfirmationQuestion';
    const CLASS_NAME_SYMFONY_QUESTION = '\Symfony\Component\Console\Question\Question';
    /**
     * @var InitCommand
     */
    private $command;

    /**
     * Build the init command before each test
     */
    public function setUp()
    {
        $this->command = new InitCommand();
    }

    /**
     * Test if command has a name
     */
    public function testConstructSetsName()
    {
        self::assertNotEmpty($this->command->getName());
    }

    /**
     * Test that the command has a description
     */
    public function testCommandHasADescription()
    {
        self::assertNotEmpty($this->command->getDescription());
    }

    /**
     * Test if the PATH option is available
     */
    public function testConstructSetsPathOption()
    {
        $pathOption = $this->command->getDefinition()->getOption(InitCommand::OPTION_PATH);
        $expected = self::CLASS_NAME_SYMFONY_INPUT_OPTION;
        $this->assertInstanceOf($expected, $pathOption);
    }

    /**
     * @return \Symfony\Component\Console\Helper\QuestionHelper|PHPUnit_Framework_MockObject_MockObject
     */
    private function getQuestionHelperMock()
    {
        $questionHelperMock = $this->getMock(self::CLASS_NAME_SYMFONY_QUESTION_HELPER);
        return $questionHelperMock;
    }

    /**
     * @return \Symfony\Component\Console\Helper\HelperSet|PHPUnit_Framework_MockObject_MockObject
     */
    private function getHelperSetMock()
    {
        $helperSetMock = $this->getMock(self::CLASS_NAME_SYMFONY_HELPER_SET);
        return $helperSetMock;
    }

    /**
     * @return \Symfony\Component\Console\Input\InputInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private function getInputInterfaceMock()
    {
        $inputMock = $this->getMock(self::CLASS_NAME_SYMFONY_INPUT_INTERFACE);
        return $inputMock;
    }

    /**
     * @return \Symfony\Component\Console\Output\OutputInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private function getOutputInterfaceMock()
    {
        $outputMock = $this->getMock(self::CLASS_NAME_SYMFONY_OUTPUT_INTERFACE);
        return $outputMock;
    }

    /**
     * @param bool $default
     * @return PHPUnit_Framework_MockObject_MockObject|\Symfony\Component\Console\Question\ConfirmationQuestion
     */
    private function getConfirmationQuestionMock($default = true)
    {
        $questionMock = $this->getMock(self::CLASS_NAME_CONFIRMATION_QUESTION, [], ['', $default]);
        return $questionMock;
    }

    /**
     * @param bool $default
     * @return PHPUnit_Framework_MockObject_MockObject|\Symfony\Component\Console\Question\Question
     */
    private function getQuestionMock($default = true)
    {
        $questionMock = $this->getMock(self::CLASS_NAME_SYMFONY_QUESTION, [], ['', $default]);
        return $questionMock;
    }
}