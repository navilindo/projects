<?php
    include('../src/connection.php');

    $db = new Db();
    $connection = $db->connect();
    
    $req = $_SERVER["REQUEST_METHOD"];

    switch($req){
        case 'GET':
            // Retrieve users
            if(!empty($_GET["id"]))
            {
                $id=intval($_GET["id"]);
                getUser($id);
            }
            elseif(!empty($_GET["name"]) && !empty($_GET["password"]) && !empty($_GET["job"])) {
                login();
            }
            elseif(!empty($_GET["id"]) && $_GET["action"] == 'login'){
                //$action = $_GET["action"];
                login();
            }
            elseif(!empty($_GET["name"]) && $_GET["action"] == 'search'){
                $word = $_GET['word']; 
                search();
            }
            else
            {
                getUsers();
            }
            break;
            default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;

        case 'POST':
            // Insert User 
            /*
            if(empty($_POST["national_id"])){
                //login($name, $password, $job);
                login();
            }
            else {
            */    
                insertUser();
            
            break;
        
        case 'PUT':
            // Update User
            $id=intval($_GET["id"]);
            updateUser($id);
            break;
        
        case 'DELETE':
            // Delete User
            $id=intval($_GET["id"]);
            deleteUser($id);
            break;

    }


    function getUsers(){
        global $connection;
        $query = "SELECT * FROM users";

        $response = array();
        $result = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($result))
        {
            $response[] = $row;
        }
        header('Content-Type: application/json');
            echo json_encode($response);
        }

        function getUser($id){
            global $connection;
            $query = "SELECT * FROM users WHERE id = $id";
            
            $response = array();
            $result = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                $response[] = $row;
            }
            header('Content-Type: application/json');
                echo json_encode($response);
        }

        // function login($name, $password, $job){
        function login(){
            global $connection;
            $logged = false;
            
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data['name'];
            $password = md5($data["password"]);
            $job = $data["job"];

            echo "hello " . $job . " " .$name;

            $query = "SELECT name, job, national_id, phone,address FROM users WHERE name = '" . $name ."' and password = '". $password . "' and job = '" . $job ."'";
    
            $response = array();
            $result = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                $logged = true;
                $response[] = $row;
                array_push($response, $logged);
            }
            header('Content-Type: application/json');
                echo json_encode($response);
        }

        function insertUser(){
            global $connection;
            
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data["name"];
            $job = $data["job"];
            $national_id = $data["national_id"];
            $password = md5($data["password"]);
            $phone = $data["phone"];
            $address = $data["address"];

            $query = "INSERT INTO `users` (`name`, `job`, `national_id`, `phone`, `address`, `password`) VALUES (' ". $name ."', '". $job ."', '" . $national_id ."', '". $phone ."', '". $address ."', '". $password ."')";

            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'User added Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Inserting user failed.'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        function search(){
            global $connection;

            $query = "select * from employee_info where department like '%$search%' or name like '%$search%'"; 
        }

        ?>
