<?php

//get list of centres
function get_centres()
{
    //make $db available inside the function
    global $db;

    try
    {
        //get centres sorted by centre names
        $query = "SELECT * FROM centre order by centrename";
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
	
//get individual centre
function get_centre($centre_id)
{
    //make $db available inside the function
    global $db;

    try
    {

        $query = "SELECT * FROM centre where centre_id = :centre_id_p";

        $statement = $db->prepare($query);
        $statement->bindValue(":centre_id_p", $centre_id);
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

//add centre
function add_centre($centre_name_v)
{
    //make $db available inside the function
    global $db;

    $query = 
    "INSERT into centre
    (centrename)
    VALUES
    (:centre_name_p)";

    try
    {
        $statement = $db->prepare($query);
        $statement->bindParam(':centre_name_p', $centre_name_v);
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


//edit centre
function edit_centre($centre_id_v, $centre_name_v)
{
    //make $db available inside the function
    global $db;

    try
    {
        //create(named) placeholders
        $query = 
        'UPDATE centre
        set centrename = :centre_name_p
        WHERE centre_id = :centre_id_p';
        
        //echo $centre_id_v." ".$centre_name_v; exit();
        
        $statement = $db->prepare($query);
        $statement->bindParam(':centre_id_p', $centre_id_v);
        $statement->bindParam(':centre_name_p', $centre_name_v);
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

//delete centre
function delete_centre($centre_id_v)
{
    //make $db available inside the function
    global $db;
    
    //delete item from database
    $query = 
    "DELETE FROM centre
    WHERE centre_id = :centre_id_p";

    try
    {
        $statement = $db->prepare($query);
        $statement -> bindParam(':centre_id_p', $centre_id_v);
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