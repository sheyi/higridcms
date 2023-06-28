<?php
class Plugin_redirect extends Plugin {

  public function index() {

    $app = \Slim\Slim::getInstance();

    $url = $this->fetch_param('to', false);
    $url = $url ? $url : $this->fetch_param('url', false);
    
    $response = $this->fetch_param('response', 302);

    if ($url) {
      $app->redirect($url, $response);
    }

  }
  
}