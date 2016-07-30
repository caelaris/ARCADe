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
     *
     */
    public function testValidatePathAsksForConfirmation()
    {
        $questionHelperMock = $this->getMock(self::CLASS_NAME_SYMFONY_QUESTION_HELPER);
        $helperSetMock = $this->getMock(self::CLASS_NAME_SYMFONY_HELPER_SET);
        $helperSetMock->expects($this->once())->method('get')->with('question')->willReturn($questionHelperMock);
        /** @noinspection PhpParamsInspection */
        $this->command->setHelperSet($helperSetMock);
        $inputMock = $this->getMock(self::CLASS_NAME_SYMFONY_INPUT_INTERFACE);
        $inputMock->expects($this->once())->method('getOption')->with(InitCommand::OPTION_PATH)->willReturn('\tmp\test');
        $outputMock = $this->getMock(self::CLASS_NAME_SYMFONY_OUTPUT_INTERFACE);

        $questionMock = $this->getMock(self::CLASS_NAME_CONFIRMATION_QUESTION, [], [], '', false);
        $questionHelperMock->expects($this->once())->method('ask')->with($inputMock, $outputMock, $questionMock);

        /** @noinspection PhpParamsInspection */
        $this->command->validatePath($inputMock, $outputMock, $questionMock);
    }

    public function testValidatePathAsksNoQuestionIfPathOptionIsNotSet()
    {
        $inputMock = $this->getMock(self::CLASS_NAME_SYMFONY_INPUT_INTERFACE);
        $inputMock->expects($this->once())->method('getOption')->with(InitCommand::OPTION_PATH)->willReturn(null);
        $outputMock = $this->getMock(self::CLASS_NAME_SYMFONY_OUTPUT_INTERFACE);

        $this->command->validatePath($inputMock, $outputMock);
    }
}