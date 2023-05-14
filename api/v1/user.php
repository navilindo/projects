
<?php 

class User{

    function add(){

        require_once '../models/user.php';

        $response = array(); 

        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(
                isset($_POST['mail']) and 
                        isset($_POST['password']))
                {
                //operate the data further 
                
                $role = 6;
                $status = 'waiting';

                $db = new UserModel(); 

                $result = $db->add( 
                    $role,
                    $_POST['mail'],
                    $_POST['password'],
                    $status
                );
                if($result == 1){
                    $response['error'] = false; 
                    $response['message'] = "User registered successfully";
                }elseif($result == 2){
                    $response['error'] = true; 
                    $response['message'] = "Some error occurred please try again";			
                }elseif($result == 0){
                    $response['error'] = true; 
                    $response['message'] = "It seems you are already registered, please choose a different email and username";						
                }

            }else{
                $response['error'] = true; 
                $response['message'] = "Required fields are missing";
            }
        }else{
            $response['error'] = true; 
            $response['message'] = "Invalid Request";
        }

        echo json_encode($response);
    }
}

function login(){

    require_once '../models/user.php';

    $response = array(); 

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['username']) and isset($_POST['password'])){
            
            $db = new UserModel(); 

            if($db->userLogin($_POST['username'], $_POST['password'])){
                $user = $db->getUserByUsername($_POST['username']);
                $response['error'] = false; 
                $response['id'] = $user['id'];
                $response['email'] = $user['email'];
                $response['username'] = $user['username'];
            }else{
                $response['error'] = true; 
                $response['message'] = "Invalid username or password";			
            }

        }else{
            $response['error'] = true; 
            $response['message'] = "Required fields are missing";
        }
    }

    echo json_encode($response);
}

//*
$us = new User();
$action = $_GET['action'];
$us->{ $action }();
// 
//*//
?>