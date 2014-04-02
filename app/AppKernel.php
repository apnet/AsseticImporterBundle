<?php

/**
 * Bundle test kernel
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
use Apnet\FunctionalTestBundle;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Bundle test kernel
 */
class AppKernel extends FunctionalTestBundle\HttpKernel\AppKernel
{

  /**
   * {@inheritdoc}
   */
  public function registerBundles()
  {
    return array(
      new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
      new Symfony\Bundle\TwigBundle\TwigBundle(),
      new Symfony\Bundle\AsseticBundle\AsseticBundle(),
      new Symfony\Bundle\MonologBundle\MonologBundle(),

      new Apnet\AsseticImporterBundle\ApnetAsseticImporterBundle(),
      new FunctionalTestBundle\ApnetFunctionalTestBundle()
    );
  }

  /**
   * {@inheritdoc}
   */
  public function registerContainerConfiguration(LoaderInterface $loader)
  {
    $loader->load(__DIR__ . "/config/config.yml");
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheDir()
  {
    return $this->rootDir.'/cache/'.$this->environment;
  }

  /**
   * {@inheritdoc}
   */
  public function getLogDir()
  {
    return $this->rootDir.'/logs';
  }

}
