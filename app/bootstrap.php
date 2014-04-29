<?php

use Symfony\Component\Debug\Debug;

if (!file_exists(dirname(__DIR__) . "/vendor/autoload.php")) {
  echo
    'Set up the project dependencies using the following commands:' . PHP_EOL .
    'curl -s http://getcomposer.org/installer | php' . PHP_EOL .
    'php composer.phar install' . PHP_EOL;
} else {
  require_once dirname(__DIR__) . "/vendor/autoload.php";

  $loader = new Composer\Autoload\ClassLoader();
  $loader->add("Apnet\\Dev\\", __DIR__ . "/src");
  $loader->register();

  chdir(dirname(__DIR__));
  Debug::enable();
}
