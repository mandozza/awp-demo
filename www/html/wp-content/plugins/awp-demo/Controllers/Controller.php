<?php namespace AwpDemo\Controllers;

use AwpDemo\Models\BaseModel as BaseModel;

/**
 * The Controller class.
 */
class Controller {

  /**
   * The BaseModel class instance.
   *
   * @var object
   */
  public $baseModel;

  /**
   * The context to pass to the view.
   *
   * @var array
   */
  public $context;

  /**
   * The Controller class constructor.
   */
  public function __construct() {
    $this->baseModel = new BaseModel();
    $this->context = $this->baseModel->getContext();
    $this->context['menu'] = $this->baseModel->getMenu();
    $this->context['footer'] = $this->baseModel->getFooter();
    $this->context['images'] = $this->baseModel->getImages();
    $this->context['isMobile'] = $this->baseModel->getIsMobile();
  }

  /**
   * Render the view.
   *
   * @param string $name The name of the view without .twig
   */
  public function renderView($name = 'page') {
    $this->context['post'] = $this->baseModel->getPost();
    \Timber::render($name . '.twig', $this->context);
  }
}
