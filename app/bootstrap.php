<?php

use Symfony\Component\Debug\Debug;

if (!file_exists(dirname(__DIR__) . "/vendor/autoload.php")) {
  echo
    'Set up the project dependencies using the following commands:' . PHP_EOL .
    'curl -s http://getcomposer.org/installer | php' . PHP_EOL .
    'php composer.phar install' . PHP_EOL;
} else {
  /* $loader = */include dirname(__DIR__) . "/vendor/autoload.php";

  chdir(dirname(__DIR__));
  Debug::enable();
}
