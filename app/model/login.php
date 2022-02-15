<?php
    $title = 'Login';
    class LoginModel{
        private $username;
        private $password;
        private $username_err;
        private $password_err;
        private $login_err;
        

        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
            $this->username = $username;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            $this->password = $password;
            return $this;
        }

        public function getUsername_err(){
            return $this->username_err;
        }
        public function setUsername_err($username_err){
            $this->username_err = $username_err;
            return $this;
        }

        public function getPassword_err(){
            return $this->password_err;
        }
        public function setPassword_err($password_err){
            $this->password_err = $password_err;
            return $this;
        }

        public function getLogin_err(){
            return $this->login_err;
        }
        public function setLogin_err($login_err){
            $this->login_err = $login_err;
            return $this;
        }
    }
?>