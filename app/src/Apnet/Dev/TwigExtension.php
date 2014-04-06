<?php

namespace Apnet\Dev;

class TwigExtension extends \Twig_Extension
{

  /**
   * {@inheritdoc}
   */
  public function getName()
  {
    return "apnet_dev";
  }

  /**
   * {@inheritdoc}
   */
  public function getFunctions()
  {
    return array(
      new \Twig_SimpleFunction('file_get_contents', 'file_get_contents'),
    );
  }

}
