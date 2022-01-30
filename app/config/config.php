<?php
  $config = [
    'MODEL_PATH' => APPLICATION_PATH.'/model/',
    'VIEW_PATH' => APPLICATION_PATH.'/view/',
    'CONTROLLER_PATH' => APPLICATION_PATH.'/controller/',
    'LIB_PATH' => APPLICATION_PATH.'/lib/',
  ];
  require 'database.php';
  require $config['LIB_PATH'].'functions.php';
  require $config['MODEL_PATH'].'constants.php';
  require $config['MODEL_PATH'].'variables.php';
?>
