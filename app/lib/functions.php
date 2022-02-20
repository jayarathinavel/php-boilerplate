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

    function isLoggedIn(){
      session_start();
      $isLoggedIn = false;
      if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true){
        $isLoggedIn = true;
      }
      return $isLoggedIn;
    }
  
    function loginRequired($redirectTo){
      session_start();
      if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login?loggedIn=no&redirectTo=$redirectTo");
        exit;
      }
    }

    function getLoginAndLogoutMessage(){
      if(isset($_GET['message']) && $_GET['message'] === 'loginSuccess'){
        $message = 'You are logged in Successfully';
      }
      elseif(isset($_GET['message']) && $_GET['message'] === 'logoutSuccess'){
        $message = 'You are logged out Successfully';
      }
      elseif(isset($_GET['message']) && $_GET['message'] === 'passwordChangeSuccess'){
        $message = 'Password Changed Successfully, please re-login again.';
      }
      return $message;
    }

    function themeSpecific($conn){
      $theme = $this -> getCurrentTheme($conn);
      if($theme == 'default' || $theme == 'cerulean' ){
        $class = [
          'navbar' => 'navbar fixed-top navbar-expand-lg navbar-dark bg-dark',
          'navbar-btn' => '',
          'form-fields' => '',
        ];
      }

      elseif($theme == 'light' ){
        $class = [
          'navbar' => 'navbar fixed-top navbar-expand-lg navbar-light bg-light',
          'navbar-btn' => '',
          'form-fields' => '',
          'footer-bar' => 'border border-top bg-light text-dark alignCenter',
        ];
      }
      return $class;
    }

    function getCurrentTheme($conn){
      $query = $conn -> query("SELECT `value` FROM `variables` WHERE `name`='theme'");
      $row = $query -> fetch_assoc();
      return $row['value'];
    }
  }
?>
