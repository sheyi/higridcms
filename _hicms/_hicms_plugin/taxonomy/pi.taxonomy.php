<?php
class Plugin_taxonomy extends Plugin {


  public function listing() {
    $app = \Slim\Slim::getInstance();

    $folder      = $this->fetch_param('folder', null); // defaults to null
    $type        = $this->fetch_param('type', null); // defaults to null
    $limit       = $this->fetch_param('limit', null, 'is_numeric'); // defaults to none
    $sort_by     = $this->fetch_param('sort_by', 'name'); // defaults to name
    $min_count   = $this->fetch_param('min_count', 1, 'is_numeric'); // defaults to 1

    if ($folder == null) {
      $folder = ltrim($this->fetch_param('from', $app->request()->getResourceUri()), "/");
    }

    if ($folder && $type) {
      $list = HiCMS::get_content_list($folder, null, null, false, true, $sort_by, null, '', null, false, false, null, null);

      $results = array();
      $urls   = array();
      $initialize = $app->config;
      foreach ($list as $key => $item) {
        $content = HiCMS::transform_content($item['content']);
        Lex_Autoloader::register();
        $parser = new Lex_Parser();
        $parser->cumulative_noparse(true);
        $parser->scope_glue(':');
        $c = $parser->parse($content, array_merge($item, $initialize));
        $list[$key]['content'] = $c;

        if (isset($item[$type])) {
          foreach ($item[$type] as $key => $value) {
            if (isset($results[$value['name']])) {
              $results[$value['name']] += 1; 
            } else {
              $results[$value['name']] = 1; 
            }

            if (isset($urls[$value['name']])) {
            } else {
              $urls[$value['name']] = $value['url'];
            }
          }
        }
      }

      if ($sort_by == 'count') {
        asort($results, SORT_STRING);
        $results = array_reverse($results);
      } else {
        ksort($results, 5);
      }

      $data = array();
      foreach ($results as $key => $value) {
        if ($value >= $min_count) {
          $arr = array(
            'name' => $key
          , 'results' => $value
          , 'url' => $urls[$key]
          );
          $data[] = $arr;
        }
      }

      if ($limit) {
        $data = array_splice($data, 0, $limit);
      }
      if (sizeof($data)) {
        return $this->parse_loop($this->content, $data);
      } else {
        $arr = array();
        $arr['no_results'] = true;
        return $arr;
      }
    }
    return array();
  }

}