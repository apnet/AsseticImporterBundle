<?php

use Symfony\Component\Debug\Debug;

if (!file_exists(dirname(__DIR__) . "/vendor/autoload.php")) {
  die(
    'You need to set up the project dependencies using the following commands:' . PHP_EOL .
    'curl -s http://getcomposer.org/installer | php' . PHP_EOL .
    'php composer.phar install' . PHP_EOL
  );
}
require_once dirname(__DIR__) . "/vendor/autoload.php";

chdir(dirname(__DIR__));
Debug::enable();
