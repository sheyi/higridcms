<?php
class Plugin_nav extends Plugin {

  public function index() {
    
    $app = \Slim\Slim::getInstance();

    $from            = $this->fetch_param('from', $app->config['current_path']);
    $exclude         = $this->fetch_param('exclude', false);
    $max_depth       = $this->fetch_param('max_depth', 1, 'is_numeric');
    $include_entries = $this->fetch_param('include_entries', false, false, true);
    $folders_only    = $this->fetch_param('folders_only', true, false, true);
    $include_content = $this->fetch_param('include_content', false, false, true);

    $url       = HiCMS_Helper::resolve_path($from);
    $tree      = HiCMS::get_content_tree($url, 1, $max_depth, $folders_only, $include_entries, true, $include_content);

    # exclude a pipe-delimited set of urls
    if ($exclude) {

      $exclude = $this->explode_options($exclude);

      foreach ($tree as $key => $item) {
        if (in_array($item['url'], $exclude) || in_array(trim($item['url'], '/'), $exclude)) {
          unset($tree[$key]);
        }
      }
    }

    if (count($tree) > 0) {
      return $this->parse_loop($this->content, $tree);
    }

    return FALSE;
  }

  public function breadcrumbs() {

  
    $app = \Slim\Slim::getInstance();

    $url          = $this->fetch_param('from', $app->config['current_path']);
    $include_home = $this->fetch_param('include_home', true, false, true);
    $reverse      = $this->fetch_param('reverse', false, false, true);
    $backspace    = $this->fetch_param('backspace', false, 'is_numeric', false);

    $url = HiCMS_Helper::resolve_path($url);

    $crumbs = array();

    if ($url != '/') {

      $segments      = explode('/', ltrim($url, '/'));
      $segment_count = count($segments);
      $segment_urls  = array();

      for ($i = 1; $i <= $segment_count; $i++) {
        $segment_urls[] = implode($segments, '/');
        array_pop($segments);
      }

      # Build array of breadcrumb pages
      foreach ($segment_urls as $key => $url) {
        $crumbs[$url] = HiCMS::fetch_content_by_url($url);
        $page_url = '/'.rtrim(preg_replace(HiCMS_helper::$numeric_regex, '', $url),'/');
        
        $crumbs[$url]['url'] = $page_url;

        $crumbs[$url]['is_current'] = $page_url == $app->config['current_url'];
      }
    }

    # Add homepage
    if ($include_home) {
      $crumbs['/'] = HiCMS::fetch_content_by_url('/');
      $crumbs['/']['url'] = HiCMS::get_site_root();
      $crumbs['/']['is_current'] = $app->config['current_url'] == '/';
    }

    # correct order
    if ($reverse !== TRUE) {
      $crumbs = array_reverse($crumbs);
    }

    $output = $this->parse_loop(trim($this->content), $crumbs);

    if ($backspace) {
      $output = substr($output, 0, -$backspace);
    }

    return $output;
  }

  public function count() {
    $app = \Slim\Slim::getInstance();

    $url = $this->fetch_param('from', $app->config['current_path']);
    $url = HiCMS_Helper::resolve_path($url);
    $max_depth = $this->fetch_param('max_depth', 1, 'is_numeric');
    $tree = HiCMS::get_content_tree($url, 1, $max_depth);
 

    if ($this->content <> '') {
      return $this->parse_loop($this->content, $tree);
    }  else {
      return count($tree);
    }
  }
  
}