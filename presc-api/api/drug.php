<?php
    include('../src/connection.php');

    $db = new Db();
    $connection = $db->connect();
    
    $req = $_SERVER["REQUEST_METHOD"];

    switch($req){
        case 'GET':
            // Retrive users
            if(!empty($_GET["id"]))
            {
                $id=intval($_GET["id"]);
                getDrug($id);
            }
            else
            {
                getDrugs();
            }
            break;
            default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;

        case 'POST':
            // Insert Drug 
            insertDrug();
            break;
        
        case 'PUT':
            // Update Drug
            $id=intval($_GET["id"]);
            updateDrug($id);
            break;
        
        case 'DELETE':
            // Delete Drug
            $id=intval($_GET["id"]);
            deleteDrug($id);
            break;
    }

    function getDrugs(){
        global $connection;
        $query = "SELECT * FROM drugs";

        $response = array();
        $result = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($result))
        {
            $response[] = $row;
        }
        header('Content-Type: application/json');
            echo json_encode($response);
        }

        function getDrug($id){
            global $connection;
            $query = "SELECT * FROM drugs WHERE id = $id";
    
            $response = array();
            $result = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                $response[] = $row;
            }
            header('Content-Type: application/json');
                echo json_encode($response);
        }

        function insertDrug(){
            global $connection;
            
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data["name"];
            $businessname = $data["businessname"];
            $code = $data["code"];
            $country = $data["country"];

            echo $query="INSERT INTO drugs SET name='". $name ."', businessname='". $businessname ."', code='". $code . "', country='" . $country . "'";
            
            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Drug added Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Inserting drug failed.'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        function updateDrug($id){
            global $connection;

            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data["name"];
            $address = $data["address"];

            $query="UPDATE drugs SET name='". $name ."name='". $businessname ."', code='". $code ."', country='" . $country . "' WHERE id=".$id;

            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Drug information updated Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Drug information update Failed.'
                );
            }
        }
  
        function deleteDrug(){
            global $connection;
            $id=intval($_GET["id"]);          
            $query="DELETE FROM drugs WHERE id=".$id;
            
            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Drug deleted Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Drug delete Failed.'
                );
            }
        }
?>