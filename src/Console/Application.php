<?php

namespace Caelaris\Arcade\Console;

use Symfony\Component\Console\Application as BaseApplication;

/**
 * Class Application
 */
class Application extends BaseApplication
{
    /**
     * Application logo
     * 
     * @link http://patorjk.com/software/taag/#p=display&f=Doom&t=ARCADe Source for the logo
     * @var string
     */
    private static $logo = '  ___  ______  _____   ___ ______     
 / _ \ | ___ \/  __ \ / _ \|  _  \    
/ /_\ \| |_/ /| /  \// /_\ \ | | |___ 
|  _  ||    / | |    |  _  | | | / _ \
| | | || |\ \ | \__/\| | | | |/ /  __/
\_| |_/\_| \_| \____/\_| |_/___/ \___|

 ';
    
    /**
     * @return string
     */
    public function getHelp()
    {
        return self::$logo . parent::getHelp();
    }
}