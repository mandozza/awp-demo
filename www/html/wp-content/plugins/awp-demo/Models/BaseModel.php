<?php namespace AwpDemo\Models;

/**
 * The BaseModel class.
 */
class BaseModel {

  /**
   * Get the context array.
   *
   * The context array is sitewide data like
   * the site name, description, and language
   *
   * @return array The context
   */
  public function getContext() {
    $context = \Timber::get_context();
    return $context;
  }

  /**
   * Get the primary nagivation menu data.
   *
   * @return object Primary navigation menu object
   */
  public function getMenu($menuSlug = 'primary_navigation') {
    $menu = new \Timber\Menu($menuSlug);
    return $menu;
  }

  /**
   * Get the footer data.
   *
   * @return array The footer data
   */
  public function getFooter() {
    $footer = [
      'copyright' => __('Copyright &copy; ' . date('Y') . ' Made By Grizzly, Inc.', 'gzwp')
    ];
    return $footer;
  }

  /**
   * Get the path to the images in the theme.
   *
   * @return string The images path
   */
  public function getImages() {
    $images = GZWP_THEME_ASSET_URI . '/images';
    return $images;
  }

  /**
   * Return true if the user is on a mobile device.
   *
   * @return bool True if the user is on a mobile device
   */
  public function getIsMobile() {
    $regex = '/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    return preg_match($regex, $userAgent);
  }

  public function getPost() {
    $post = new \Timber\Post();
    return $post;
  }
}
