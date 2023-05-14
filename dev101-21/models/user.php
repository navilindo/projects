<?php

//function view($id){

    
    $query = "SELECT * from alt.users where id = 1";
    //echo '1 + 2';
    
    $result = $dbcon->query($query);
    //echo '3 + 4';
    
    if($result->num_rows > 0){
        echo 'db query was successful <br>';
        $user = mysqli_fetch_all($result);        
        
    }
    else echo 'db query not successful';
//}

?>
