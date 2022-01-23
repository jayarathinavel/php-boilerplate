<?php
  defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__).'/../app'));
  require(APPLICATION_PATH.'/config/config.php');

  $page = getPageName();
  $model = $config['MODEL_PATH'].$page.'.php';
  $view = $config['VIEW_PATH'].$page.'.phtml';
  $controller = $config['CONTROLLER_PATH'].$page.'.php';
  $fileNotFound = $config['VIEW_PATH'].'404.phtml';

  if(file_exists($model)){
    require $model;
  }
  if (file_exists($controller)) {
    require $controller;
  }
  if (file_exists($view)) {
    require $view;
  }
  else {
    require $fileNotFound;
  }
?>
