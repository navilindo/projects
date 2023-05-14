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
                getPrescription($id);
            }
            else
            {
                getPrescriptions();
            }
            break;
            default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;

        case 'POST':
            // Insert Prescription 
            insertPrescription();
            break;
        
        case 'PUT':
            // Update Prescription
            $id=intval($_GET["id"]);
            updatePrescription($id);
            break;
        
        case 'DELETE':
            // Delete Prescription
            $id=intval($_GET["id"]);
            deletePrescription($id);
            break;
    }

    function getPrescriptions(){
        global $connection;
        $query = "SELECT * FROM prescriptions";

        $response = array();
        $result = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_array($result))
        {
            $response[] = $row;
        }
        header('Content-Type: application/json');
            echo json_encode($response);
        }

        function getPrescription($id){
            global $connection;
            $query = "SELECT * FROM prescriptions WHERE id = $id";
    
            $response = array();
            $result = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                $response[] = $row;
            }
            header('Content-Type: application/json');
                echo json_encode($response);
        }

        function insertPrescription(){
            global $connection;
            
            $data = json_decode(file_get_contents('php://input'), true);
            $clinic = $data["clinic"];
            $patient = $data["patient"];
            $drug = $data["drug"];
            $quantity = $data["quantity"];
            $doctor = $data["doctor"];
            $date = $data["date"];
            $usage_amount = $data["usage_amount"];
            $usage_times = $data["usage_times"];

            $query="INSERT INTO prescriptions SET clinic='". $clinic ."', patient='". $patient ."', drug='". $drug . "', quantity='". $quantity . "', doctor='". $doctor . "', date='". $date . "', usage_amount='" . $usage_amount . "', usage_times='" . $usage_times . "'";
            $q = "INSERT INTO `prescriptions` (`id`, `clinic`, `patient`, `drug`, `quantity`, `doctor`, `date`, `usage_amount`, `usage_times`) VALUES (NULL, '$clinic', '$patient', '$drug', '$quantity', '$doctor', '$date', '$usage_amount', '$usage_times')";
            echo $q;
            if(mysqli_query($connection, $q))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Prescription added Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Inserting Prescription failed.'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        function updatePrescription($id){
            global $connection;

            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data["name"];
            $address = $data["address"];

            $query="UPDATE prescriptions SET name='". $name ."', sddress='". $address ."' WHERE id=".$id;

            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Prescription information updated Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Prescription information update Failed.'
                );
            }
        }
  
        function deletePrescription(){
            global $connection;
            $id=intval($_GET["id"]);          
            $query="DELETE FROM prescriptions WHERE id=".$id;
            
            if(mysqli_query($connection, $query))
            {
                $response=array(
                    'status' => 1,
                    'status_message' => 'Prescription deleted Successfully.'
                );
            }
            else{
                $response=array(
                    'status' => 0,
                    'status_message' => 'Prescription delete Failed.'
                );
            }
        }
?>