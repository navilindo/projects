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
                getClinic($id);
            }
            else
            {
                getClinics();
            }
            break;
            default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;

        case 'POST':
            // Insert clinic 
            insertClinic();
            break;
        
        case 'PUT':
            // Update clinic
            $id=intval($_GET["id"]);
            updateClinic($id);
            break;
        
        case 'DELETE':
            // Delete clinic
            $id=intval($_GET["id"]);
            deleteClinic($id);
            break;
    }

    function getClinics(){
        global $connection;
        $query = "SELECT * FROM clinics";

        $response = array();
        $result = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($result))
        {
            $response[] = $row;
        }
        header('Content-Type: application/json');
            echo json_encode($response);
        }

        function getClinic($id){
            global $connection;
            $query = "SELECT * FROM clinics WHERE id = $id";
    
            $response = array();
            $result = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                $response[] = $row;
            }
            header('Content-Type: application/json');
                echo json_encode($response);
        }

        function insertClinic(){
            global $connection;
            
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data["name"];
            $address = $data["address"];

            echo $query="INSERT INTO clinics SET name='". $name ."', address='". $address ."'";
            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Clinic added Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Inserting clinic failed.'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        function updateClinic($id){
            global $connection;

            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data["name"];
            $address = $data["address"];

            $query="UPDATE clinics SET name='". $name ."', sddress='". $address ."' WHERE id=".$id;

            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Clinic information updated Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Clinic information update Failed.'
                );
            }
        }
  
        function deleteClinic(){
            global $connection;
            $id=intval($_GET["id"]);          
            $query="DELETE FROM clinics WHERE id=".$id;
            
            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Clinic deleted Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Clinic delete Failed.'
                );
            }
        }
?>