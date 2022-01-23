<?php
function getPageName(){
  return ($_SERVER['REQUEST_URI'] != '/') ? $_SERVER['REQUEST_URI'] : 'home';
}
?>
