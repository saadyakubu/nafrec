<?php
    //show errors
    ini_set('display_errors',1);
    error_reporting(E_ALL);

    //use for initial test 
    //exit(print_r($_POST));

    //get form data
    $centre_name_v = $_POST['centre_name'];

    $pattern ='/^[a-zA-Z0-9\-_\s]+$/';
    $valid_name = preg_match($pattern, $centre_name_v);
    //echo $valid_name; //test output: should be 1 (i.e., valid)
    //exit();
    
    //validate inputs - must contain all required fields
    if(empty($centre_name_v))
    {
        $error="Centre field requires data. Enter a centre and try again.";
        include("../../global/error.php");
    }
    elseif($valid_name === false)
    {
        echo "Error in pattern";
    }
    elseif($valid_name === 0)
    {
        $error = "Centre Name can only contain letters, numbers, hyphens and underscores";
        include("../../global/error.php");
    }
    else
    {	
        require_once('../../global/connection.php');
        require_once('../../global/functions_centre.php');
        //echo $centre_name_v; exit();
        add_centre($centre_name_v);
    }
?>

<link rel="stylesheet" href="../css/admin.css">
<?php require_once '../templates/top.php'; ?>
<?php include_once "../templates/bottom.php"; ?>