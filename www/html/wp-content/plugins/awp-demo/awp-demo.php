<?php namespace AwpDemo;

/**
 * Plugin Name:       AWP Demo
 * Description:       The AWP Demo Plugin
 * Version:           1.0.0
 * Author:            Grizzly
 * Author URI:        https://madebygrizzly.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gzwp
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

if (!class_exists(__NAMESPACE__ . '\AwpDemo')) {

  /**
   * The main AwpDemo class (Singleton).
   */
  final class AwpDemo {

    /**
     * The minimum PHP version needed to run AWP Demo.
     */
    const PHP_MIN_VERISON = '7.0';

    /**
     * The base directory where the views live.
     */
    const VIEWS_BASE_DIR = 'views';

    /**
     * The asset destination directory for the theme.
     */
    const THEME_ASSET_DIR = 'dist';

    /**
     * The name of the rev manifest file.
     */
    const THEME_ASSET_REV = 'rev-manifest.json';

    /**
     * The CoreAddons class instance.
     *
     * @var object
     */
    private $coreAddons;

    /**
     * The PluginAddons class instance.
     *
     * @var object
     */
    private $pluginAddons;

    /**
     * The ThemeSupport class instance.
     *
     * @var object
     */
    private $themeSupport;

    /**
     * The ImageSizes class instance.
     *
     * @var object
     */
    private $imageSizes;

    /**
     * The ThemeAssets class instance.
     *
     * @var object
     */
    private $themeAssets;

    /**
     * The ThemeMenus class instance.
     *
     * @var object
     */
    private $themeMenus;

    /**
     * The ThemeCustomFields class instance.
     *
     * @var object
     */
    private $themeFields;

    /**
     * The TinyMCE class instance.
     *
     * @var object
     */
    private $tinymce;

    /**
     * The AdminAssets class instance.
     *
     * @var object
     */
    private $adminAssets;

    /**
     * The ViewLoader class instance.
     *
     * @var object
     */
    private $viewLoader;

    /**
     * The AwpDemo class instance.
     *
     * @var object
     */
    private static $instance;

    /**
     * Returns the main AwpDemo class instance.
     *
     * @return object AwpDemo
     */
    public static function getInstance() {
      if (is_null(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
    * The AwpDemo class constructor.
    */
    public function __construct() {

      // Bail if minimum PHP version requirement is not met.
      if (version_compare(self::PHP_MIN_VERISON, phpversion(), '>')) {
        add_action('admin_notices', [$this, 'phpUpdateNotice']);
        return;
      }

      $this->constants();
      $this->includes();
      $this->initCore();
      $this->initTheme();
      $this->initAdmin();
      $this->initHooks();
    }

    /**
    * Hook into actions and filters.
    */
    private function initHooks() {
      add_action('plugins_loaded', [$this, 'initPlugin'], 0);
    }

    /**
    * AWP Demo core initalization.
    */
    public function initCore() {
      $this->coreAddons   = new Helpers\Core\CoreAddons();
      $this->pluginAddons = new Helpers\Core\PluginAddons();
    }

    /**
    * AWP Demo theme initalization.
    */
    public function initTheme() {
      $this->themeSupport = new Helpers\Theme\ThemeSupport();
      $this->imageSizes   = new Helpers\Theme\ImageSizes();
      $this->themeAssets  = new Helpers\Theme\ThemeAssets();
      $this->themeMenus   = new Helpers\Theme\ThemeMenus();
      $this->themeFields  = new Helpers\Theme\ThemeCustomFields();
    }

    /**
    * AWP Demo admin initalization.
    */
    public function initAdmin() {
      $this->adminAssets = new Helpers\Admin\AdminAssets();
      $this->tinymce     = new Helpers\Admin\TinyMCE();
    }

    /**
    * Initialization that runs on the 'plugins_loaded' hook.
    */
    public function initPlugin() {
      $this->viewLoader = new Helpers\ViewLoader(self::VIEWS_BASE_DIR);
    }

    /**
    * Define plugin constants.
    */
    private function constants() {
      define('GZWP_PLUGIN_DIR', plugin_dir_path(__FILE__));
      define('GZWP_THEME_DIR', get_theme_file_path());
      define('GZWP_THEME_URI', get_theme_file_uri());
      define('GZWP_THEME_ASSET_DIR', GZWP_THEME_DIR . '/' . self::THEME_ASSET_DIR);
      define('GZWP_THEME_ASSET_URI', GZWP_THEME_URI . '/' . self::THEME_ASSET_DIR);
      define('GZWP_THEME_ASSET_REV', self::THEME_ASSET_REV);
    }

    /**
    * Include required files.
    */
    private function includes() {
      require_once GZWP_PLUGIN_DIR . 'vendor/autoload.php';
      require_once GZWP_PLUGIN_DIR . 'utilities/pretty-print.php';
    }


    /**
    * Cloning is forbidden.
    */
    public function __clone() {
      _doing_it_wrong(__FUNCTION__, __('AwpDemo cannot be cloned.', 'gzwp'), '1.0.0');
    }

    /**
    * Unserializing is forbidden.
    */
    public function __wakeup() {
      _doing_it_wrong(__FUNCTION__, __('AwpDemo cannot be unserialized.', 'gzwp'), '1.0.0');
    }

    /**
    * Show PHP update notice.
    */
    public function phpUpdateNotice() {
      if (!is_admin()) {
        return;
      }
      $notice_heading = __('PHP Update Required', 'gzwp');
      $notice_body = sprintf(__('AWP Demo requires PHP version %s or later.', 'gzwp'), self::PHP_MIN_VERISON);
      $notice_markup .= '<p><strong>' . $notice_heading . '</strong></p>';
      $notice_markup .= '<p>' . $notice_body . '</p>';
      $notice = sprintf('<div class="notice notice-error">%1$s</div>', $notice_markup);
      echo $notice;
    }
  }
}

/**
* Start AWP Demo
*
* The main function responsible for returning
* the one true AwpDemo instance.
*
* @return object AwpDemo
*/
function AwpDemo() {
  return AwpDemo::getInstance();
}
AwpDemo();
