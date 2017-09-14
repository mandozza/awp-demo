<?php namespace AwpDemo;

use AwpDemo\Helpers\ViewLoader as ViewLoader;

/**
 * Test the ViewLoader class.
 */
final class TestViewLoader extends \WP_UnitTestCase {

  /** @test */
  public function can_get_location_paths() {
    $viewLoader = new ViewLoader('views');
    $test_data_dir = dirname(__FILE__) . '/../data';
    $loctions = $viewLoader->getLocationPaths($test_data_dir);
    $this->assertEquals(count($loctions), 2);
    $dir_1 = explode('/', $loctions[0]);
    $dir_1 = end($dir_1);
    $dir_2 = explode('/', $loctions[1]);
    $dir_2 = end($dir_2);
    $this->assertSame('test-subdirectory-1', $dir_1);
    $this->assertSame('test-directory-2', $dir_2);
  }
}
