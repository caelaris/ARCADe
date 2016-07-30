<?php
use Caelaris\Arcade\Command\InitCommand;

/**
 * Class InitCommandTest
 */
class InitCommandTest extends PHPUnit_Framework_TestCase
{
    const CLASS_NAME_SYMFONY_INPUT_OPTION = '\Symfony\Component\Console\Input\InputOption';
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
}