<?php
    include('../src/connection.php');

    $db = new Db();
    $connection = $db->connect();
    
    $req = $_SERVER["REQUEST_METHOD"];

    switch($req){
        case 'GET':
            // Retrive patients
            if(!empty($_GET["id"]))
            {
                $id=intval($_GET["id"]);
                getPatient($id);
            }
            else
            {
                getPatients();
            }
            break;
            default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;

        case 'POST':
            // Insert Patient 
            insertPatient();
            break;
        
        case 'PUT':
            // Update Patient
            $id=intval($_GET["id"]);
            updatePatient($id);
            break;
        
        case 'DELETE':
            // Delete Patient
            $id=intval($_GET["id"]);
            deletePatient($id);
            break;
    }

    function getPatients(){
        global $connection;
        $query = "SELECT * FROM patients";

        $response = array();
        $result = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($result))
        {
            $response[] = $row;
        }
        header('Content-Type: application/json');
            echo json_encode($response);
        }

        function getPatient($id){
            global $connection;
            $query = "SELECT * FROM patients WHERE id = $id";
    
            $response = array();
            $result = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                $response[] = $row;
            }
            header('Content-Type: application/json');
                echo json_encode($response);
        }

        function insertPatient(){
            global $connection;
            
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data["name"];
            $gender = $data["gender"];
            $address = $data["address"];
            $national_id = $data["national_id"];
            $age = $data["age"];
            $phone = $data["phone"];

            $query="INSERT INTO patients SET name='". $name ."', gender='". $gender ."', address='". $address . "', national_id='". $national_id . "', age='" . $age . "', phone='" . $phone . "'";
            
            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Patient added Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Inserting Patient failed.'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        function updatePatient($id){
            global $connection;

            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data["name"];
            $address = $data["address"];

            $query="UPDATE patients SET name='". $name ."name='". $businessname ."', code='". $code ."', country='" . $country . "' WHERE id=".$id;

            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Patient information updated Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Patient information update Failed.'
                );
            }
        }
  
        function deletePatient(){
            global $connection;
            $id=intval($_GET["id"]);          
            $query="DELETE FROM patients WHERE id=".$id;
            
            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Patient deleted Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Patient delete Failed.'
                );
            }
        }
?>