<?php

/**
 * Test twig extension
 *
 * @author Andrey F. Mindubaev <covex.mobile@gmail.com>
 * @license http://opensource.org/licenses/MIT  MIT License
 */
namespace Apnet\AsseticImporterBundle\Tests\Twig\Extension;

use Apnet\FunctionalTestBundle\Framework\WebTestCase;
use Apnet\AsseticImporterBundle\Twig\Extension\ImporterExtension;

/**
 * Test twig extension
 */
class ImportedExtensionTest extends WebTestCase
{

  /**
   * Test importer_asset twig function
   *
   * @return null
   */
  public function testImporterAsset()
  {
    $extension = $this->_getTwigExtension();

    $this->assertEquals(
      '/test2/style2.css',
      $extension->importedAsset('test2/style2.css')
    );
  }

  /**
   * Test importer_asset twig function
   *
   * @return null
   * @expectedException \Symfony\Component\Routing\Exception\RouteNotFoundException
   */
  public function testImporterAssetException()
  {
    $extension = $this->_getTwigExtension();

    $this->assertEquals(
      null,
      $extension->importedAsset('not_exists')
    );
  }

  /**
   * Get extension service
   *
   * @return ImporterExtension
   */
  private function _getTwigExtension()
  {
    $client = self::createClient();
    return $client->getContainer()
      ->get('apnet.assetic.importer_twig_extension');
  }

}
