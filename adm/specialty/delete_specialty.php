<?php
    //show errors
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //get item ID
    $specialty_id_v = $_POST['specialty_id'];

    require_once('../../global/connection.php');
    require_once '../../global/functions_specialty.php';
    //delete item from database
    delete_specialty($specialty_id_v);
?>