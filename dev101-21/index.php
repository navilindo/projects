<?php

if (isset($_GET['ctrl']) && isset($_GET['action'])) {
    
    $ctrl = $_GET['ctrl'];
    $action     = $_GET['action'];
    //echo "were are set C & V bro</br> controller is " . $ctrl . " and view is " . $action;
} else {
    
    $ctrl = 'pages';
    $action     = 'home';
    //echo "it seems there are some problems</br>";
}

require_once('ui/layout.php');
/*
if(isset($_POST['out'])){	
    // remove all session variables
    //session_unset();
    // destroy the session
    //session_destroy();
}
*/

?>