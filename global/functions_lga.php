<?php


//get lga based on specified id
function get_lga($lga_id_v)
{
    //make $db available inside the function
    global $db;

    try
    {

        $query = "SELECT * FROM v_lga where lga_id = :lga_id_p";

        $statement = $db->prepare($query);
        $statement->bindValue(":lga_id_p", $lga_id_v);
        $statement->execute();

        //fetches next (or first) row from a result set
        $result = $statement->fetch();
        return $result;
    }
    catch(PDOException $e)
    {
        $error = $e->getMessage();
        display_db_error(); //found in connection.php, redirects page to error.php
    }
}


//get all lgas 
//also use this function to display the list of states
function get_lgas()
{
    //make $db available inside the function
    global $db;

    //get specialties sorted by specialty names
    $query = "SELECT * FROM v_lga order by lga_state";

    try
    {
        $statement = $db->prepare($query);
        $statement->execute();

        //fetches all rows from a result set
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    catch(PDOException $e)
    {
        $error = $e->getMessage();
        display_db_error(); //found in connection.php, redirects page to error.php
    }
}

//get all states
//also use this function to display the list of states
function get_states()
{
    //make $db available inside the function
    global $db;

    //get states sorted from Abia to Zamfara
    $query = "SELECT distinct lga_state FROM v_lga order by lga_state";

    try
    {
        $statement = $db->prepare($query);
        $statement->execute();

        //fetches all rows from a result set
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    catch(PDOException $e)
    {
        $error = $e->getMessage();
        display_db_error(); //found in connection.php, redirects page to error.php
    }
}
	
//get all lga for a specified state
function get_state_lgas($lga_state_v)
{
    //make $db available inside the function
    global $db;

    try
    {

        $query = "SELECT * FROM v_lga where lga_state = :lga_state_p";

        $statement = $db->prepare($query);
        $statement->bindValue(":lga_state_p", $lga_state_v);
        $statement->execute();

        //fetches next (or first) row from a result set
        $result = $statement->fetchAll();
        return $result;
    }
    catch(PDOException $e)
    {
        $error = $e->getMessage();
        display_db_error(); //found in connection.php, redirects page to error.php
    }
}

//add lga to a state
function add_lga($lga_state_v, $lga_name_v)
{
    //make $db available inside the function
    global $db;

    $query = 
    "INSERT into lga
    (lga_state, lga_name)
    VALUES
    (:lga_state_p, :lga_name_p)";

    try
    {
        $statement = $db->prepare($query);
        $statement->bindParam(':lga_state_p', $lga_state_v);
        $statement->bindParam(':lga_name_p', $lga_name_v);
        $statement->execute();
        $statement->closeCursor();

        //display index page
        header("location: index.php");
    }
    catch(PDOException $e)
    {
        $error = $e->getMessage();
        display_db_error();
    }
}


//edit lga details
function edit_lga($lga_id_v, $lga_state_v, $lga_name_v)
{
    //make $db available inside the function
    global $db;

    try
    {   
        //create(named) placeholders
        $query = 
        'UPDATE lga
        set lga_state = :lga_state_p, lga_name= :lga_name_p 
        WHERE lga_id = :lga_id_p';
        
        //echo $lga_id_v."".$lga_state_v."".$lga_name_v."!";        exit();

        $statement = $db->prepare($query);
        $statement->bindParam(':lga_id_p', $lga_id_v);
        $statement->bindParam(':lga_state_p', $lga_state_v);
        $statement->bindParam(':lga_name_p', $lga_name_v);
        $statement->execute();  
        $statement->closeCursor();

        $db=null;

        //display index page
        header("location: index.php");
    }
    catch(PDOException $e)
    {
        $error = $e->getMessage();
        display_db_error(); 
    }
}

//delete lga
function delete_lga($lga_id_v)
{
    //make $db available inside the function
    global $db;

    //delete item from database
    $query = 
    "DELETE FROM lga
    WHERE lga_id = :lga_id_p";

    try
    {
        $statement = $db->prepare($query);
        $statement -> bindParam(':lga_id_p', $lga_id_v);
        $row_count = $statement->execute();
        $statement->closeCursor();

        //display index page
        header('Location: index.php');
    }
    catch(PDOException $e)
    {
        $error = $e->getMessage();
        display_db_error();
    }
}

?>