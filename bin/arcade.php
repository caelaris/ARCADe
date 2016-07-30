#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Caelaris\Arcade\Command\InitCommand;
use Symfony\Component\Console\Application;

$application = new Application('ARCADe (A Rapid Console Application Development tool)', '0.1-dev');
$application->add(new InitCommand());
$application->run();
