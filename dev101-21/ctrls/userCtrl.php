<?php

class UserCtrl{
    
    public function index(){
            if(isset($_POST['login'])){
                header('location:?controller=user&action=home');
            $user = User::index();
        }
        include('views/user/index.php');
    }
    
    public function logout(){
        if(isset($_POST['yes'])){
            header('location:index.php');
            $user = User::logout();
        }
        include('views/user/logout.php');
    }		
}

?>