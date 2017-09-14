<?php namespace AwpDemo;

/**
 * Test the main plugin instance.
 */
final class TestAwpDemo extends \WP_UnitTestCase {

  /**
   * The test directory with trailing slash.
   *
   * @var string
   */
  public $testDir;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->testDir = 'tests/unit-tests/';
  }

  /** @test */
  public function has_class_instance() {
    $this->assertClassHasStaticAttribute('instance', 'AwpDemo\AwpDemo');
  }

  /** @test */
  public function has_correct_constants() {

    // PLUGIN DIR
    $path = str_replace($this->testDir, '', plugin_dir_path(__FILE__));
    $this->assertSame(GZWP_PLUGIN_DIR, $path);

    // THEME DIR
    $theme_name = explode('/', get_theme_file_path());
    $theme_name = end($theme_name);
    $const_name = explode('/', GZWP_THEME_DIR);
    $const_name = end($const_name);
    $this->assertSame($const_name, $theme_name);

    // Theme URI
    $theme_name = explode('/', get_theme_file_uri());
    $theme_name = end($theme_name);
    $const_name = explode('/', GZWP_THEME_URI);
    $const_name = end($const_name);
    $this->assertSame($const_name, $theme_name);
  }

  /** @test */
  public function has_required_files() {
    $this->assertFileExists(GZWP_PLUGIN_DIR . 'vendor/autoload.php');
    $this->assertFileExists(GZWP_PLUGIN_DIR . 'utilities/pretty-print.php');
  }
}
