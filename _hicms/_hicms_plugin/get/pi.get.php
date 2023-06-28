<?php
class Plugin_get extends Plugin {

  static public function __callStatic($method, $args) {
    
    return isset($_GET[$method]) ? $_GET[$method] : false;
  }
  
}