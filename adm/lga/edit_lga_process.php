<?php
    //show errors
    ini_set('display_errors',1);
    error_reporting(E_ALL);

    //use for initial test 
    //exit(print_r($_POST));

    //get form data
    $lga_id_v = $_POST['lga_id']; 
    $lga_state_v = $_POST['lga_state'];
    $lga_name_v = $_POST['lga_name'];

    $pattern ='/^[a-zA-Z\-_\s]+$/';
    $valid_name = preg_match($pattern, $lga_name_v);
    //echo $valid_name; //test output: should be 1 (i.e., valid)
    //exit();
    
    //validate inputs - must contain all required fields
    if(empty($lga_name_v) || empty($lga_state_v))
    {
        $error="All fields requires data. Select a State, LGA and try again.";
        include("../../global/error.php");
    }
    elseif($valid_name === false)
    {
        echo "Error in pattern";
    }
    elseif($valid_name === 0)
    {
        $error = "LGA Name can only contain letters";
        include("../../global/error.php");
    }
    else
    {	
        require_once('../../global/connection.php');
        require_once('../../global/functions_lga.php');
        //echo $lga_id_v." ".$lga_state_v." ".$lga_name_v; exit();
        edit_lga($lga_id_v, $lga_state_v, $lga_name_v);
    }
?>

<link rel="stylesheet" href="../css/admin.css">
        <?php require_once '../templates/top.php'; ?>
<?php include_once "../templates/bottom.php"; ?>