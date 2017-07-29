<?php
    //get total number of registered candidates stats
    function get_dssc_total_stats()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            $sql = "SELECT count(*) number FROM v_dssc_app_aggregate_others";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();

            //fetches the row from a result set
            $result = $statement->fetch();
            
            $statement->closeCursor();
            return $result;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    //get today's stats
    function get_dssc_today_stats()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            //extract the date portion from the datetime attribute
            $sql = "SELECT count(*) number FROM v_dssc_app_aggregate_others where DATE(reg_date) = current_date()";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();

            //fetches the row from a result set
            $result = $statement->fetch();
            
            $statement->closeCursor();
            return $result;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    
    //get 7 days' stats
    function get_dssc_week_stats()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            //extract the date portion from the registration datetime attribute and subtract 7 days (range 7 days from today)
            $sql = "SELECT count(*) number FROM v_dssc_app_aggregate_others where (DATE(reg_date)) >= (current_date()-7)";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();

            //fetches all rows from a result set
            $result = $statement->fetch();
            
            $statement->closeCursor();
            return $result;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }

    //get the current month's stats
    function get_dssc_current_month_stats()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            //return registrations done where reg month is the same as the current month
            $sql = "SELECT count(*) number FROM v_dssc_app_aggregate_others where MONTH(DATE(reg_date)) = MONTH(current_date())";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();
        
            //fetches all rows from a result set
            $result = $statement->fetch();
            
            $statement->closeCursor();
            return $result;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }


    //get the number of candidates per centre
    function get_dssc_total_registered_per_centre()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            //return registrations done where reg month is the same as the current month
            $sql = "select centrename, count(centrename) as 'number' from v_dssc_app_aggregate_others group by centrename";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();
        
            //fetches all rows from a result set
            $results = $statement->fetchAll();
            
            $statement->closeCursor();
            return $results;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    //get the total number of pending applications
    function get_dssc_total_pending_app()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            //return registrations done where reg month is the same as the current month
            $sql = "select count(*) number from v_dssc_pending_applications";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();
        
            //fetches a row from a result set
            $result = $statement->fetch();
            
            $statement->closeCursor();
            return $result;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    //get the total number of completed applications
    function get_dssc_total_completed_app()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            //return registrations done where reg month is the same as the current month
            $sql = "select count(*) number from v_dssc_completed_applications";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();
        
            //fetches a row from a result set
            $result = $statement->fetch();
            
            $statement->closeCursor();
            return $result;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        } 
    }
    
    
    //get the total number of completed applications
    function get_dssc_specialty_stats()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            $sql = "select specialty, count(specialty) number from v_dssc_app_aggregate_others group by specialty";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();
        
            //fetches a row from a result set
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
    
    //get the total number of completed applications per state
    function get_dssc_states_stats()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            $sql = "select state, count(state) number from v_dssc_app_aggregate_others group by state";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();
        
            //fetches a row from a result set
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
    
    //get the total number of registered personnel
    function get_dssc_personnel_stats()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            $sql = "select count(*) number from v_dssc_military_exp";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();
        
            //fetches a row from a result set
            $result = $statement->fetch();
            
            $statement->closeCursor();
            return $result;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        } 
    }
    
    //get the total number of eligible applications
    function get_dssc_eligible()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            //return registrations done where reg month is the same as the current month
            $sql = "select count(*) number from v_eligible_dssc";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();
        
            //fetches a row from a result set
            $result = $statement->fetch();
            
            $statement->closeCursor();
            return $result;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    //get the total number of eligible applications
    function get_dssc_ineligible()
    {
        //make $db available inside the function
        global $db;
        
        try
        {
            //return registrations done where reg month is the same as the current month
            $sql = "select count(*) number from v_non_eligible_dssc";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($sql);
            $statement->execute();
        
            //fetches a row from a result set
            $result = $statement->fetch();
            
            $statement->closeCursor();
            return $result;
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
     
?>