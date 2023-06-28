<?php
class Plugin_post extends Plugin {

  static public function __callStatic($method, $args) {
    
    return isset($_POST[$method]) ? $_POST[$method] : false;

  }
  
}