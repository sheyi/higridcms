<?php
class Hooks_member extends Hooks {

  public function login() {

    $app = \Slim\Slim::getInstance();

    $username = $app->request()->post('username');
    $password = $app->request()->post('password');
    $return   = $app->request()->post('return');

    $errors = array();

    if (HiCMS_Auth::login($username, $password)) {
      $app->flash('success', 'Success');
      $app->redirect($return);
    } else {
      $app->flash('error', 'Failure');
      $app->redirect($return);
    }

  }

  public function logout() {
    
    $app = \Slim\Slim::getInstance();
    $return = $app->request()->get('return') ? HiCMS::get_site_root().$app->request()->get('return') : HiCMS::get_site_root();
    
    HiCMS_Auth::logout();

    $app->redirect($return);
  }

}