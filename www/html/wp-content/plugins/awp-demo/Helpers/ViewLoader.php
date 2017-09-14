<?php namespace AwpDemo\Helpers;

/**
 * The ViewLoader class.
 */
class ViewLoader {

  /**
   * The base directory where the views live.
   *
   * @var string
   */
  private $base;

  /**
   * The ViewLoader class constructor.
   *
   * @param string $base The name of the base directory where the views live.
   */
  public function __construct($base) {
    $this->base = GZWP_THEME_DIR . '/' . $base;
    $this->init();
  }

  /**
   * Initialize Timber.
   */
  private function init() {
    $this->timber = new \Timber\Timber();
    $this->initTwigFiles();
  }

  /**
   * Get the paths where the twig files live.
   *
   * @param string [$directory] The directory name override.
   * @return array An array of location directory paths.
   */
  public function getLocationPaths($directory = null) {
    if ($directory) {
      $base_dir = $directory;
    } else {
      $base_dir = $this->base;
    }
    $locations = [];
    $dirs = array_filter(glob($base_dir . '/*'), 'is_dir');
    foreach ($dirs as $dir) {
      $sub_dirs = array_filter(glob($dir . '/*'), 'is_dir');
      if (!empty($sub_dirs)) {
        array_push($locations, $sub_dirs);
      } else {
        array_push($locations, [$dir]);
      }
    }
    if (!empty($locations)) {
      $locations = array_merge(...$locations);
    }
    return $locations;
  }

  /**
   * Let Timber know where the twig files are.
   */
  private function initTwigFiles() {
    \Timber::$locations = $this->getLocationPaths();
  }
}
