<?php
    $title = 'Dashboard';
    class DashboardModel{
        private $new_password;
        private $confirm_password;
        private $new_password_err;
        private $confirm_password_err ;

        public function getNewPassword(){
            return $this->new_password;
        }
        public function setNewPassword($new_password){
            $this->new_password = $new_password;
            return $this;
        }

        public function getConfirmPassword(){
            return $this->confirm_password;
        }
        public function setConfirmPassword($confirm_password){
            $this->confirm_password = $confirm_password;
            return $this;
        }

        public function getNewPasswordErr(){
            return $this->new_password_err;
        }
        public function setNewPasswordErr($new_password_err){
            $this->new_password_err = $new_password_err;
            return $this;
        }

        public function getConfirmPasswordErr(){
            return $this->confirm_password_err;
        }
        public function setConfirmPasswordErr($confirm_password_err){
            $this->confirm_password_err = $confirm_password_err;
            return $this;
        }
    }
?>