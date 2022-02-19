<?php
  class Functions{
    function getPageName(){
      $pageName = $_SERVER['REQUEST_URI'];
      if($this -> containsWord($pageName, '?')){
        $pageNameSplit = explode('?', $pageName);
        $pageName = $pageNameSplit[0];
      }
      return ($pageName != '/') ? $pageName : 'home';
    }
  
    function containsWord($str, $word){
      return (bool) preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
    }
  }
?>
