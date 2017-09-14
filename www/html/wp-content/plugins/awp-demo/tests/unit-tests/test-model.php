<?php namespace AwpDemo;

use AwpDemo\Models\BaseModel as BaseModel;

/**
 * Test the BaseModel class.
 */
final class TestBaseModel extends \WP_UnitTestCase {

  /**
   * The BaseModel class instance.
   *
   * @var object
   */
  public $baseModel;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $this->baseModel = new BaseModel();
  }

  /** @test */
  public function can_get_the_context() {
    $context = $this->baseModel->getContext();
    $this->assertArrayHasKey('site', $context);
  }

  /** @test */
  public function can_get_post_data() {
    $post = $this->baseModel->getPost();
    $this->assertObjectHasAttribute('ID', $post);
  }

  /** @test */
  public function can_get_menu_data() {
    $menu = $this->baseModel->getMenu();
    $this->assertObjectHasAttribute('items', $menu);
  }
}
