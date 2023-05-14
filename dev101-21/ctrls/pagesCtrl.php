<?php
    class PagesCtrl {

        public function home() {
            require_once('ui/pages/home.php');
        }
        
        public function error() {
            require_once('ui/pages/error.php');
        }

        public function login_error() {
            require_once('ui/pages/login_error.php');
        }
    
    }
?>
