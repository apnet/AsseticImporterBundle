<?php

/**
 * Test bundle
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticCompassBundle\Tests;

use Apnet\FunctionalTestBundle\Framework\WebTestCase;
use Apnet\FunctionalTestBundle\Framework\Client;

/**
 * Test Framework\WebTestCase class
 */
class BundleTest extends WebTestCase
{

  /**
   * Test client
   *
   * @return null
   */
  public function testClient()
  {
    $client = self::createClient();

    $this->assertTrue($client instanceof Client);
  }

}
