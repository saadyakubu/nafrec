<?php
    //show errors
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //get item ID
    $lga_id_v = $_POST['lga_id'];
     //echo $lga_id_v; exit();
    require_once('../../global/connection.php');
    require_once '../../global/functions_lga.php';
    //delete item from database
    delete_lga($lga_id_v);
?>