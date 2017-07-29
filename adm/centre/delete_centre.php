<?php
    //show errors
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //get item ID
    $centre_id_v = $_POST['centre_id'];

    require_once('../../global/connection.php');
    require_once '../../global/functions_centre.php';
    //delete item from database
    delete_centre($centre_id_v);
?>