<?php

  function getPageName(){
    $pageName = $_SERVER['REQUEST_URI'];
    if(containsWord($pageName, '?')){
      $pageNameSplit = explode('?', $pageName);
      $pageName = $pageNameSplit[0];
    }
    return ($pageName != '/') ? $pageName : 'home';
  }

  function containsWord($str, $word){
    return !!preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
  }

  //For Logout
  if (isset($_GET['query']) && ($_GET['query']) == 'logout' ) {
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location: home");
    exit;
  }

?>
