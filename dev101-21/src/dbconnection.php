<?php
    $host = 'localhost';
    $db = 'alt';
    $user = 'rooter';
    $password = 'toor';
    
    $dbcon = new mysqli($host, $user,$password,$db);
    
    if($dbcon){
         //echo 'Db connection successful';
    } else echo 'Db connection failed';
?>
