<?php namespace AwpDemo\Helpers\Admin;

/**
 * The Controller class.
 */
class AdminAssets {

  /**
   * The ThemeAssets class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_action('admin_enqueue_scripts', [$this, 'enqueue']);
  }

  /**
   * Enqueue assets for the admin.
   */
  public function enqueue() {

    // admin.js
    wp_enqueue_script(
      'grizzly/admin-js',
      GZWP_THEME_ASSET_URI . '/scripts/admin.js',
      ['jquery'],
      null,
      true
    );
  }
}
