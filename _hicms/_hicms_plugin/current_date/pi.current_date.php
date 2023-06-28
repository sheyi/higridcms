<?php
class Plugin_current_date extends Plugin {

  public function index() {
    $format = $this->fetch_param('format', 'Y-m-d', false, false, false);
    return date($format);
  }
}