<?php
    //show errors
    ini_set('display_errors',1);
    error_reporting(E_ALL);

    //use for initial test 
    //exit(print_r($_POST));

    //get form data
    $specialty_name_v = $_POST['specialty_name'];

    $pattern ='/^[a-zA-Z\-_\s]+$/';
    $valid_name = preg_match($pattern, $specialty_name_v);
    //echo $valid_name; //test output: should be 1 (i.e., valid)
    //exit();
    
    //validate inputs - must contain all required fields
    if(empty($specialty_name_v))
    {
        $error="Trade Name field requires data. Enter a Trade Name and try again.";
        include("../../global/error.php");
    }
    elseif($valid_name === false)
    {
        echo "Error in pattern";
    }
    elseif($valid_name === 0)
    {
        $error = "Trade Name can only contain letters, hyphens and underscores";
        include("../../global/error.php");
    }
    else
    {	
        require_once('../../global/connection.php');
        require_once('../../global/functions_specialty.php');
        //echo $specialty_name_v; exit();
        $specialty_type_v = "Recruit";
        add_specialty($specialty_name_v, $specialty_type_v);

    }
?>
<link rel="stylesheet" href="../css/admin.css">
        <?php require_once '../templates/top.php'; ?>
<?php include_once "../templates/bottom.php"; ?>