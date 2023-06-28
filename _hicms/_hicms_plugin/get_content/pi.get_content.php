<?php
class Plugin_get_content extends Plugin {

  public function index() {
    $from = $this->fetch_param('from', false); // defaults to null

    if ($from) {
      $data = null;
      $content_root = HiCMS::get_content_root();
      $content_type = HiCMS::get_content_type();

      if (file_exists("{$content_root}/{$from}.{$content_type}") || is_dir("{$content_root}/{$from}")) {
        // endpoint or folder exists!
      } else {
        $from = HiCMS_Helper::resolve_path($from);
      }

      if (file_exists("{$content_root}/{$from}.{$content_type}")) {
        // @todo: Load Post if a date/numerical entry, else page
        $page     = basename($from);
        $folder   = substr($from, 0, (-1*strlen($page))-1);

        $data = HiCMS::get_content_meta($page, $folder);
      } else if (is_dir("{$content_root}/{$from}")) {
        $data = HiCMS::get_content_meta("page", $from);
      }

      if ($data) {
        return $data;
      }
    }

    return "";
  }

}