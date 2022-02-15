<?php
    $title = "Sign Up";
    class RegisterModel{
        private $username;
        private $password;
        private $confirm_password;
        private $username_err;
        private $password_err;
        private $confirm_password_err;

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

        public function getConfirm_password(){
            return $this->confirm_password;
        }

        public function setConfirm_password($confirm_password){
            $this->confirm_password = $confirm_password;
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

        public function getConfirm_password_err(){
            return $this->confirm_password_err;
        }

        public function setConfirm_password_err($confirm_password_err){
            $this->confirm_password_err = $confirm_password_err;
            return $this;
        }
    }
?>
