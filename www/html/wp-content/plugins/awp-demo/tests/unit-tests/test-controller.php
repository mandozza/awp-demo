<?php namespace AwpDemo;

use AwpDemo\Controllers\Controller as Controller;
use AwpDemo\Models\BaseModel as BaseModel;

/**
 * Test the Controller class.
 */
final class TestController extends \WP_UnitTestCase {

  /** @test */
  public function can_instantiate_a_model() {
    $controller = new Controller();
    $this->assertInstanceOf(BaseModel::class, $controller->baseModel);
  }

  /** @test */
  public function can_render_a_view() {
    $controller = new Controller();
    $controller->renderView();
    $this->assertArrayHasKey('post', $controller->context);
  }
}
