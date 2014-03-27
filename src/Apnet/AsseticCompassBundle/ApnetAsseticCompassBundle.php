<?php

/**
 * Apnet Assetic Compass Bundle
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticCompassBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Apnet Assetic Compass Bundle
 */
class ApnetAsseticCompassBundle extends Bundle
{

  /**
   * {@inheritdoc}
   */
  public function build(ContainerBuilder $container)
  {
//    $container->addCompilerPass(
//      new DependencyInjection\Compiler\TestClientPass()
//    );
  }

}
