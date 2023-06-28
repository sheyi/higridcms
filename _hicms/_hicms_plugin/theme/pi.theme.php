<?php
class Plugin_theme extends Plugin {

  function __construct() {
    parent::__construct();

    $this->app = \Slim\Slim::getInstance();
    $this->theme_assets_path = HiCMS::get_theme_assets_path();
    $this->theme_path = HiCMS::get_theme_path();
    $this->theme_root = HiCMS::get_templates_path();
    $this->site_root  = HiCMS::get_site_root();
  }

  # Usage example: {{ theme:partial src="sidebar" }}
  public function partial() {
    
    $src = $this->fetch_param('src', null);

    if ($src) {
      $src .= ".html";

      $partial_path = $this->theme_root . 'partials/' . ltrim($src, '/');
      if (file_exists($partial_path)) {
        HiCMS_View::$_dataStore = array_merge(HiCMS_View::$_dataStore, $this->attributes);
        return $this->parser->parse(file_get_contents($partial_path), HiCMS_View::$_dataStore, 'HiCMS_View::callback');
      }
    }

    return null;
  }

  # Usage example: {{ theme:asset src="file.ext" }}
  public function asset() {
    $src = $this->fetch_param('src', HiCMS::get_theme().'.js');
    $file = $this->theme_path.$this->theme_assets_path.$src;
    return $this->site_root.$file;
  }

  # Usage example: {{ theme:js src="jquery" }}
  public function js() {
    $src = $this->fetch_param('src', HiCMS::get_theme().'.js');
    $file = $this->theme_path.$this->theme_assets_path.'js/'.$src;
    $cache_bust = $this->fetch_param('cache_bust', HiCMS::get_setting('_theme_cache_bust', false), false, true, true);

    # Add '.js' to the end if not present.
    if ( ! preg_match("(\.js)", $file)) {
      $file .= '.js';
    }

    if ($cache_bust && file_exists($file)) {
      $file .= '?v='.$last_modified = filemtime($file);
    }

    return $this->site_root.$file;
  }

  # Usage example: {{ theme:css src="primary" }}
  public function css() {
    $src        = $this->fetch_param('src', HiCMS::get_theme().'.css');
    $file       = $this->theme_path.$this->theme_assets_path.'css/'.$src;
    $cache_bust = $this->fetch_param('cache_bust', HiCMS::get_setting('_theme_cache_bust', false), false, true, true);

    # Add '.css' to the end if not present.
    if (! preg_match("(\.css)", $file)) {
      $file .= '.css';
    }

    // Add cache busting query string
    if ($cache_bust && file_exists($file)) {
      $file .= '?v='.$last_modified = filemtime($file);
    }

    return $this->site_root.$file;
  }

  # Usage example: {{ theme:img src="logo.png" }}
  public function img() {
    $src  = $this->fetch_param('src', null);
    $file = $this->theme_path.$this->theme_assets_path.'img/'.$src;
    $cache_bust = $this->fetch_param('cache_bust', HiCMS::get_setting('_theme_cache_bust', false), false, true, true);

    if ($cache_bust && file_exists($file)) {
      $file .= '?v='.$last_modified = filemtime($file);
    }

    return $this->site_root.$file;
  }
}