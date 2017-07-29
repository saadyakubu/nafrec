<?php
    session_start();
    //username and password sent from the login form
    $username_v= $_POST['username'];
    $userpswd_v = $_POST['userpswd'];

    //exit(print_r($_POST));

    $pattern ='/^[a-zA-Z0-9\-_\s]+$/';
    $valid_username = preg_match($pattern, $username_v);
    //echo valid_uname; //test output: should be 1 (i.e., valid)
    //exit();   
    
    $pattern ='/^[a-zA-Z0-9\-_\s]+$/';
    $valid_userpswd = preg_match($pattern, $userpswd_v);
    //echo $valid_upwd; //test output: should be 1 (i.e., valid)
    //exit();
    
    //validate inputs - must contain all required fields
    if(empty($username_v) || empty($userpswd_v))
    {
        $error="All fields require data. Check all fields and try again.";
        include("global/error.php");
    }
    elseif($valid_username === false)
    {
        echo "Error in pattern";
    }
    elseif($valid_username === 0)
    {
        $error = "Username can only contain letters, numbers, hyphens and underscores";
        include("global/error.php");
    }
    elseif($valid_userpswd === false)
    {
        echo "Error in pattern";
    }
    elseif($valid_userpswd === 0)
    {
        $error = "Password can only contain letters, numbers, hyphens and underscores";
        include("global/error.php");
    }
    else
    {
        //include data validation here...
        require_once "global/connection.php";

        $query = 
        "SELECT * 
        FROM login
        WHERE username = :username_p
        AND password  = :userpswd_p";

        //display query statememnt, then exit (for testing purposes only)
        //exit($query);

        $statement = $db->prepare($query);
        $statement->bindParam(':username_p', $username_v);
        $statement->bindParam(':userpswd_p', $userpswd_v);
        $statement->execute();
        $result = $statement->fetch();

        //for testing
        //exit(print_r($result));

        //frees up connection to server so that other SQL statements may be issued
        $statement->closeCursor();

        //close connection by destroying object
        $db = null;

        //verify result set returned, based upon matched $username_v and $userpswd_v
        if($result)
        {
            $_SESSION['uid'] = $result['username']; //store user session value
            //navigate to various directories based on different roles (DIT and DRRR)

            if($result['role'] == 'Admin1')
            {
                header("location:adm/overview.php");
            }
            else if($result['role'] == 'Admin2')
            {
                header("location:admdrrr/overview.php"); 
            }     
        }
        else
        {
            echo "Incorrect Username or Password. <br/> Please <a href='login.php'>login</a>";
        }        
    }
?>