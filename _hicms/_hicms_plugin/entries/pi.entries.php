<?php
class Plugin_entries extends Plugin {


  public function page() {
    $app = \Slim\Slim::getInstance();
    $path = $this->fetch_param('path', null); // defaults to null

    if ($path == null) {
      return "";
    } else {
      $data = null;
      $content_root = HiCMS::get_content_root();
      $content_type = HiCMS::get_content_type();

      if (file_exists("{$content_root}/{$path}.{$content_type}") || is_dir("{$content_root}/{$path}")) {
        // endpoint or folder exists!
      } else {
        $path = HiCMS_Helper::resolve_path($path);
      }

      if (file_exists("{$content_root}/{$path}.{$content_type}")) {
        // @todo: Load Post if a date/numerical entry, else page
        $page     = basename($path);
        $folder   = substr($path, 0, (-1*strlen($page))-1);

        $data = HiCMS::get_content_meta($page, $folder);
      } else if (is_dir("{$content_root}/{$path}")) {
        $data = HiCMS::get_content_meta("page", $path);
      }

      if ($data) {
        return $data;
      }
    }

    return "";
  }

  public function listing() {
    $app = \Slim\Slim::getInstance();

    $taxonomy_slugify = HiCMS::get_setting('_taxonomy_slugify', false);

    $folder      = $this->fetch_param('folder', null); // defaults to null
    $limit       = $this->fetch_param('limit', null, 'is_numeric'); // defaults to none
    $offset      = $this->fetch_param('offset', 0, 'is_numeric'); // defaults to zero
    $show_future = $this->fetch_param('show_future', false, false, true); // defaults to no
    $show_past   = $this->fetch_param('show_past', true, false, true); // defaults to yes
    $sort_by     = $this->fetch_param('sort_by', 'date'); // defaults to date
    $sort_dir    = $this->fetch_param('sort_dir', 'desc'); // defaults to desc
    $conditions  = $this->fetch_param('conditions', null, false, false, false); // defaults to null
    $slug        = $this->fetch_param('slug', null); // defaults to null
    $taxonomy    = $this->fetch_param('taxonomy', false, false, true); // defaults to false
    $switch      = $this->fetch_param('switch', null); // defaults to null
    $since       = $this->fetch_param('since', null); // defaults to null
    $until       = $this->fetch_param('until', null); // defaults to null
    $paginate    = $this->fetch_param('paginate', true, false, true); // defaults to true

    if ($folder == null) {
      $folder = ltrim($this->fetch_param('from', $app->request()->getResourceUri()), "/");
    }

    if ($taxonomy) {
      list($type, $tax_slug) = HiCMS::get_taxonomy_criteria($app->request()->getResourceUri());
      $tax_slug = $taxonomy_slugify ? HiCMS_Helper::deslugify($tax_slug) : urldecode($tax_slug);
      $conditions = "{$type}:{$tax_slug}";
    }

    if ($limit && $paginate) {
      // override limit/offset if paging
      $pagination_variable = HiCMS::get_pagination_variable();
      $page = $app->request()->get($pagination_variable) ? $app->request()->get($pagination_variable) : 1;
      $offset = (($page * $limit) - $limit) + $offset;
    }

    if ($folder) {
      $list = HiCMS::get_content_list($folder, $limit, $offset, $show_future, $show_past, $sort_by, $sort_dir, $conditions, $switch, false, false, $since, $until);
      if (sizeof($list)) {

        foreach ($list as $key => $item) {
          $list[$key]['content'] = HiCMS::parse_content($item['content'], $item);
        }

        return $this->parse_loop($this->content, $list);

      } else {
        return array('no_results' => true);
      }
      
    }
    return array();
  }


  public function pagination() {
    $app = \Slim\Slim::getInstance();
    
    $taxonomy_slugify = HiCMS::get_setting('_taxonomy_slugify', false);

    $folder         = $this->fetch_param('folder', null); // defaults to no
    $limit          = $this->fetch_param('limit', 10, 'is_numeric'); // defaults to none
    $show_future    = $this->fetch_param('show_future', false, false, true); // defaults to no
    $show_past      = $this->fetch_param('show_past', true, false, true); // defaults to yes
    $conditions     = $this->fetch_param('conditions', null, false, false, false); // defaults to null
    $taxonomy       = $this->fetch_param('taxonomy', false, false, true); // defaults to false
    $since          = $this->fetch_param('since', null); // defaults to null
    $until          = $this->fetch_param('until', null); // defaults to null

    if ($folder == null) {
      $folder = ltrim($this->fetch_param('from', $app->request()->getResourceUri()), "/");
    }

    if ($taxonomy) {
      list($type, $tax_slug) = HiCMS::get_taxonomy_criteria($app->request()->getResourceUri());

      if($taxonomy_slugify) {
        $tax_slug = HiCMS_Helper::deslugify($tax_slug);
      } else {
        $tax_slug = urldecode($tax_slug);
      }

      $conditions = "{$type}:{$tax_slug}";
    }

    $style = $this->fetch_param('style', 'prev_next'); // defaults to date
    $count = HiCMS::get_content_count($folder, $show_future, $show_past, $conditions, $since, $until);

    $pagination_variable = HiCMS::get_pagination_variable();
    $page = $app->request()->get($pagination_variable) ? $app->request()->get($pagination_variable) : 1;

    
    $arr = array();
    $arr['total_items']        = (int) max(0, $count);
    $arr['items_per_page']     = (int) max(1, $limit);
    $arr['total_pages']        = (int) ceil($count / $limit);
    $arr['current_page']       = (int) min(max(1, $page), max(1, $page));
    $arr['current_first_item'] = (int) min((($page - 1) * $limit) + 1, $count);
    $arr['current_last_item']  = (int) min($arr['current_first_item'] + $limit - 1, $count);
    $arr['previous_page']      = ($arr['current_page'] > 1) ? "?{$pagination_variable}=".($arr['current_page'] - 1) : FALSE;
    $arr['next_page']          = ($arr['current_page'] < $arr['total_pages']) ? "?{$pagination_variable}=".($arr['current_page'] + 1) : FALSE;
    $arr['first_page']         = ($arr['current_page'] === 1) ? FALSE : "?{$pagination_variable}=1";
    $arr['last_page']          = ($arr['current_page'] >= $arr['total_pages']) ? FALSE : "?{$pagination_variable}=".$arr['total_pages'];
    $arr['offset']             = (int) (($arr['current_page'] - 1) * $limit);

    return $this->parser->parse($this->content, $arr);
  }

}