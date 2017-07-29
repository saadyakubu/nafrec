<?php


//get specialties for dssc
function get_specialties()
{
    //make $db available inside the function
    global $db;

    //get specialties sorted by specialty names
    $query = "SELECT * FROM v_specialty order by specialty_name";

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

//get trades for recruits
function get_trades()
{
    //make $db available inside the function
    global $db;

    //get specialty sorted by ID
    $query = "SELECT * FROM v_trade order by specialty_name";

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

//get all specialties and trades
function get_all_specialties()
{
    //make $db available inside the function
    global $db;
    
    //get specialties sorted by specialty names (both specialties and trades)
    $query = "SELECT * FROM specialty order by specialty_type, specialty_name";

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
	
	
	
//get individual specialty
function get_specialty($specialty_id)
{
    //make $db available inside the function
    global $db;

    try
    {

        $query = "SELECT * FROM v_specialty where specialty_id = :specialty_id_p";

        $statement = $db->prepare($query);
        $statement->bindValue(":specialty_id_p", $specialty_id);
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

//get individual trade
function get_trade($specialty_id)
{
    //make $db available inside the function
    global $db;

    try
    {

        $query = "SELECT * FROM v_trade where specialty_id = :specialty_id_p";

        $statement = $db->prepare($query);
        $statement->bindValue(":specialty_id_p", $specialty_id);
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

//add specialty
function add_specialty($specialty_name_v, $specialty_type_v)
{
    //make $db available inside the function
    global $db;

    $query = 
    "INSERT into specialty
    (specialty_name, specialty_type)
    VALUES
    (:specialty_name_p, :specialty_type_p)";

    try
    {
        $statement = $db->prepare($query);
        $statement->bindParam(':specialty_name_p', $specialty_name_v);
        $statement->bindParam(':specialty_type_p', $specialty_type_v);
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


//edit specialty
function edit_specialty($specialty_id_v, $specialty_name_v, $specialty_type_v)
{
    //make $db available inside the function
    global $db;

    try
    {
        //create(named) placeholders
        $query = 
        'UPDATE specialty
        set specialty_name = :specialty_name_p, specialty_type= :specialty_type_p 
        WHERE specialty_id = :specialty_id_p';

        $statement = $db->prepare($query);
        $statement->bindValue(':specialty_id_p', $specialty_id_v);
        $statement->bindValue(':specialty_name_p', $specialty_name_v);
        $statement->bindValue(':specialty_type_p', $specialty_type_v);
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

//delete specialty
function delete_specialty($specialty_id_v)
{
    //make $db available inside the function
    global $db;

    //delete item from database
    $query = 
    "DELETE FROM specialty
    WHERE specialty_id = :specialty_id_p";

    try
    {
        $statement = $db->prepare($query);
        $statement -> bindParam(':specialty_id_p', $specialty_id_v);
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