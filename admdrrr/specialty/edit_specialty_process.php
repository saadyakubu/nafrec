<?php
	//show errors
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	//use for initial test 
	//exit(print_r($_POST));

	//get form data
	$specialty_id_v = $_POST['specialty_id'];
	$specialty_name_v = $_POST['specialty_name'];
	
	$pattern ='/^[a-zA-Z\-_\s]+$/';
    $valid_name = preg_match($pattern, $specialty_name_v);
    //echo $valid_name; //test output: should be 1 (i.e., valid)
    //exit();

    
    //validate inputs - must contain all required fields
    if(empty($specialty_name_v))
    {
        $error="Specialty Name field requires data. Enter a Specialty Name and try again.";
        include("../../global/error.php");
    }
    elseif($valid_name === false)
    {
        echo "Error in pattern";
    }
    elseif($valid_name === 0)
    {
        $error = "Specialty Name can only contain letters, hyphens and underscores";
        include("../../global/error.php");
    }
	else
	{	
            try
            {
                require_once('../../global/connection.php');
                require_once('../../global/functions_specialty.php');
                $specialty_type_v = "DSSC";
                //echo $specialty_id_v." ".$specialty_name_v; exit();
                edit_specialty($specialty_id_v, $specialty_name_v, $specialty_type_v);
            }
            catch(PDOException $e)
            {
                    $error = $e->getMessage();
                    echo $error;
            }
  
	}
?>
<link rel="stylesheet" href="../css/admin.css">
        <?php require_once '../templates/top.php'; ?>
<?php include_once "../templates/bottom.php"; ?>