<?php namespace AwpDemo\Helpers\Theme;

use AwpDemo\Helpers\AssetPath as AssetPath;

/**
 * The ThemeAssets class.
 */
class ThemeAssets {

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
    add_action('wp_enqueue_scripts', [$this, 'enqueue'], 100);
    add_action('after_setup_theme', [$this, 'editorStyles']);
  }

  /**
   * Enqueue assets for the theme.
   */
  public function enqueue() {

    // main.css
    wp_enqueue_style(
      'grizzly/css',
      AssetPath::get('styles/main.css'),
      [],
      null
    );

    // vendor.js
    wp_enqueue_script(
      'grizzly/vendor-js',
      AssetPath::get('scripts/vendor.js'),
      ['jquery'],
      null,
      true
    );

    // app.js
    wp_enqueue_script(
      'grizzly/js',
      AssetPath::get('scripts/app.js'),
      ['jquery', 'grizzly/vendor-js'],
      null,
      true
    );
  }

  /**
   * Pipe the styles into the admin editor.
   */
  public function editorStyles() {
    add_editor_style(AssetPath::get('styles/main.css'));
  }
}
