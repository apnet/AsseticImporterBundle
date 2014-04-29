<?php

/**
 * Test bundle
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests;

use Apnet\FunctionalTestBundle\Framework\WebTestCase;

/**
 * Test bundle
 */
class ApnetAsseticImporterBundleTest extends WebTestCase
{

  /**
   * Test client
   *
   * @param string $source Source path in app/Resources
   * @param string $target Target path
   *
   * @return null
   * @dataProvider staticCollectionProvider
   */
  public function testStaticCollection($source, $target)
  {
    $client = self::createClient();

    $client->request("GET", $target);
    $response = $client->getResponse();

    $this->assertEquals(200, $response->getStatusCode());

    $container = $client->getContainer();
    $path = $container->getParameter("kernel.root_dir") . "/Resources" . $source;

    $this->assertEquals(
      file_get_contents($path), $response->getContent()
    );
  }

  /**
   * testStaticCollection dataProvider
   *
   * @return array
   */
  public function staticCollectionProvider()
  {
    return array(
      array(
        "/assets/style1.css",
        "/test2/style2.css"
      ),
      array(
        "/assets/dir1/style.css",
        "/test1/dir2/style.css"
      ),
      array(
        "/assets/compass_project1/stylesheets/screen.css",
        "/scss_project1/stylesheets/screen.css"
      ),
      array(
        "/assets/readme_md/stylesheets/screen.css",
        "/readme_md/stylesheets/screen.css"
      ),
      array(
        "/assets/pre_project1/destination/script.js",
        "/filters_project1/destination/script.js"
      )
    );
  }
}
