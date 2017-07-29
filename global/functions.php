<?php
    
    //get individual centre
    function getCandidatesPerCentre($centrename)
    {    
        //make $db available inside the function
        global $db;
        
        try
        {
            $query = "select app_pk, ID, concat(surname,' ',middlename,' ',firstname) as name, state, lga, dob, specialty
                     from v_dssc_app_aggregate_others where centrename = :centrename_p 
                     order by state, lga, surname, middlename, firstname";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($query);
	    $statement->bindValue(':centrename_p',$centrename);
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);

            //fetches all rows from a result set
            $result = $statement->fetchAll();           // print_r($result);
            return $result;
            
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
/* 
-- 2. recruit or dssc
-- show details of all registered candidates (aggregate views, mil exp, h inst, cert, prysec, rec_o_level (recruits)
-- show details of all duplicates
-- show details of all eligibles
-- show details of all non-eligibles
-- 
*/

    function getApplicantMenu($menuOption)
    {
        $sql = "";
        if($menuOption == '0')
        {
            //$sql = "SELECT * FROM v_dssc_app_aggregate_others";
            /*$sql = "select distinct ID as 'Applicant NAF ID', concat(surname,' ',middlename,' ',firstname) Name, mobile Mobile, email Email, sex Sex, 
                    (TIMESTAMPDIFF(YEAR, dob, concat(Year(current_date()),'-12-31'))) Age, 
                    height Height, state State, lga LGA, centrename Centre, specialty Specialty, course_name 'Course Read', institution_name 'Higher Institution'
                    from v_dssc_app_aggregate_others join v_dssc_app_h_inst
                    where v_dssc_app_aggregate_others.app_pk = v_dssc_app_h_inst.applicant_app_pk 
                    order by centre, state, lga, Name";*/
            $sql = "select distinct ID as 'Applicant NAF ID', concat(surname,' ',middlename,' ',firstname) Name, mobile Mobile, email Email, sex Sex, 
                    (TIMESTAMPDIFF(YEAR, dob, concat(Year(current_date()),'-12-31'))) Age, 
                    height Height, state State, lga LGA, centrename Centre, specialty Specialty
                    from v_dssc_app_aggregate_others join v_dssc_app_h_inst
                    where v_dssc_app_aggregate_others.app_pk = v_dssc_app_h_inst.applicant_app_pk 
                    order by centre, state, lga, Name";
        }
        if($menuOption == '1')
        {
            //$sql = "select * from step_three_dssc_potential_duplicates"; //"SELECT * FROM v_duplicates_dssc";
            $sql = "select distinct ID as 'Applicant NAF ID', concat(surname,' ',middlename,' ',firstname) Name, 
                    (TIMESTAMPDIFF(YEAR, dob, concat(Year(current_date()),'-12-31'))) Age, 
                    state State, lga LGA, course_name 'Course Read', potential_duplicates 'Potential Duplicates'
                    from step_three_dssc_potential_duplicates 
                    order by  Name";
        }
        else if($menuOption == '2')
        {
            //$sql = "SELECT * FROM v_eligible_dssc";
            /*$sql = "select distinct ID as 'Applicant NAF ID', concat(surname,' ',middlename,' ',firstname) Name, mobile Mobile, email Email, sex Sex, 
                    (TIMESTAMPDIFF(YEAR, dob, concat(Year(current_date()),'-12-31'))) Age, 
                    height Height, state State, lga LGA, centrename Centre, specialty Specialty, course_name 'Course Read', institution_name 'Higher Institution'
                    from v_eligible_dssc join v_dssc_app_h_inst
                    where v_eligible_dssc.app_pk = v_dssc_app_h_inst.applicant_app_pk 
                    order by centre, state, lga, Name";*/
            $sql = "select distinct ID as 'Applicant NAF ID', concat(surname,' ',middlename,' ',firstname) Name, mobile Mobile, email Email, sex Sex, 
                    (TIMESTAMPDIFF(YEAR, dob, concat(Year(current_date()),'-12-31'))) Age, 
                    height Height, state State, lga LGA, centrename Centre, specialty Specialty
                    from v_eligible_dssc 
                    order by centre, state, lga, Name";
        }
        elseif($menuOption == '3')
        {            
            /*$sql = "select distinct ID as 'Applicant NAF ID', concat(surname,' ',middlename,' ',firstname) Name, mobile Mobile, email Email, sex Sex, 
                    (TIMESTAMPDIFF(YEAR, dob, concat(Year(current_date()),'-12-31'))) Age, 
                    height Height, state State, lga LGA, centrename Centre, specialty Specialty,mental_status 'Mental Status', criminal_record 'Criminal Record'
                    from v_non_eligible_dssc 
                    order by centre, state, lga, Name";*/
            $sql = "select distinct ID as 'Applicant NAF ID', concat(surname,' ',middlename,' ',firstname) Name, mobile Mobile,  sex Sex, 
                    (TIMESTAMPDIFF(YEAR, dob, concat(Year(current_date()),'-12-31'))) Age, 
                    height Height, state State, lga LGA, centrename Centre, specialty Specialty,mental_status 'Mental Status', criminal_record 'Criminal Record'
                    from v_non_eligible_dssc 
                    order by centre, state, lga, Name";
        }
        else
        {
            /*$sql = "select distinct ID as 'Applicant NAF ID', concat(surname,' ',middlename,' ',firstname) Name, mobile Mobile, email Email, sex Sex, 
                    (TIMESTAMPDIFF(YEAR, dob, concat(Year(current_date()),'-12-31'))) Age, 
                    height Height, state State, lga LGA, centrename Centre, specialty Specialty, course_name 'Course Read', institution_name 'Higher Institution'
                    from v_dssc_app_aggregate_others join v_dssc_app_h_inst
                    where v_dssc_app_aggregate_others.app_pk = v_dssc_app_h_inst.applicant_app_pk 
                    order by centre, state, lga, Name";*/
        }
        
        return $sql;
    }
    
    
    //get duplicates details
    function getDuplicatesDetails($name_v, $state_v, $lga_v)//($surname_v, $firstname_v, $state_v, $lga_v)
    {    
        //make $db available inside the function
        global $db;
        
        try
        {
            /*$query = "select concat(surname,' ',firstname) name, 
                        dob, state, lga , passport_url, email, mobile                   
                     from v_duplicates_dssc ";
                     //where surname = :surname_p                     
                     //and firstname = :firstname_p
                     //and state = :state_p
                     //and lga = :lga_p";*/
            $query = "select concat(surname,' ',firstname) name, 
                        dob, state, lga , passport_url, email, mobile                   
                     from v_duplicates_dssc
                     where :name_p  like concat(surname,'%',firstname)
                     and state = :state_p  and lga = :lga_p";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($query);
	    //$statement->bindValue(':app_pk_p',$app_pk_v);
            //$statement->bindValue(':surname_p', $surname_v);
            //$statement->bindValue(':middlename_p', $middlename_v);
            //$statement->bindValue(':firstname_p', $firstname_v);
            $statement->bindValue(':name_p', $name_v);
            $statement->bindValue(':state_p', $state_v);
            $statement->bindValue(':lga_p', $lga_v);
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);

            //fetches all rows from a result set
            $result = $statement->fetchAll();           // print_r($result);
            return $result;
            
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }

    
    //get candidate details
    function getCandidateDetails($app_pk_v)
    {    
        //make $db available inside the function
        global $db;
        
        try
        {
            $query = "select app_pk, ID, concat(surname,' ',middlename,' ',firstname) name, mobile , email, sex, dob,height, state, lga, height, 
                        centrename, specialty, nationality, state, height, marital, religion, occupation, hobbies, 
                        criminal_record, centrename,  mobile, email, contact_address, permanent_address, mental_status, 
                        physical_status, passport_url, dob_url, o_level_url, degree_hnd_url, doc_cert_1, doc_cert_2, doc_cert_3                    
                        from v_dssc_app_aggregate_others where ID = :app_pk_p";
            
            

            //because no user entered data, no need to bind values
            $statement = $db->prepare($query);
	    //$statement->bindValue(':app_pk_p',$app_pk_v);
            //$statement->bindValue(':surname_p',$app_pk_v);
            $statement->bindValue(':app_pk_p',$app_pk_v);
            
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);

            //fetches all rows from a result set
            $result = $statement->fetch();           // print_r($result);
            return $result;
            
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    //get candidate primary and secondary school details
    function getCandidatePrySecDetails($app_pk_v)
    {    
        //make $db available inside the function
        global $db;
        
        try
        {
            $query = "select app_pk, school_name, school_type, start_year, end_year, cert_obtained                  
                        from v_dssc_app_prysec where app_pk = :app_pk_p order by school_type";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($query);
	    $statement->bindValue(':app_pk_p',$app_pk_v);
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);

            //fetches all rows from a result set
            $result = $statement->fetchAll();           // print_r($result);
            return $result;
            
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    //get candidate higher institution details
    function getCandidateHigherInstitutionDetails($app_pk_v)
    {    
        //make $db available inside the function
        global $db;
        
        try
        {
            $query = "select applicant_app_pk, h_institution_id, institution_name, start_year, end_year, course_name, qualification, grade              
                        from v_dssc_app_h_inst where applicant_app_pk = :app_pk_p";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($query);
	    $statement->bindValue(':app_pk_p',$app_pk_v);
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);

            //fetches all rows from a result set
            $result = $statement->fetchAll();           // print_r($result);
            return $result;
            
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    //get candidate cert details
    function getCandidateCertificationDetails($app_pk_v)
    {    
        //make $db available inside the function
        global $db;
        
        try
        {
            $query = "select applicant_app_pk, certification_name, certifying_body, year
                     from v_dssc_app_cert where applicant_app_pk = :app_pk_p";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($query);
	    $statement->bindValue(':app_pk_p',$app_pk_v);
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);

            //fetches all rows from a result set
            $result = $statement->fetchAll();           // print_r($result);
            return $result;
            
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    
    //get candidate cert details
    function getCandidateMilitaryExperienceDetails($app_pk_v)
    {    
        //make $db available inside the function
        global $db;
        
        try
        {
            $query = "select app_pk, service_type, rank 
                     from v_dssc_military_exp where app_pk = :app_pk_p";

            //because no user entered data, no need to bind values
            $statement = $db->prepare($query);
	    $statement->bindValue(':app_pk_p',$app_pk_v);
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);

            //fetches all rows from a result set
            $result = $statement->fetch();           // print_r($result);
            return $result;
            
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
    //get candidate details
    function getCandidateStatus($app_pk_v)
    {    
        //make $db available inside the function
        global $db;
        
        $status="";
        
        try
        {
            $query = "select * from v_dssc_completed_applications where applicant_app_pk = :app_pk_p";
            //because no user entered data, no need to bind values
            $statement = $db->prepare($query);
            $statement->bindValue(':app_pk_p',$app_pk_v);
            
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);

            //fetches all rows from a result set
            $completed_status = $statement->fetch();           // print_r($result);
            //return $result;
            $statement->closeCursor();
            
            if(!$completed_status)
            {
                return $status = "Pending Completion";
            }
            else
            {
                //confirm eligibility on Trade
                
                $query = "select * from v_eligible_dssc where app_pk = :app_pk_p";
                //because no user entered data, no need to bind values
                $statement = $db->prepare($query);
                $statement->bindValue(':app_pk_p',$app_pk_v);
                $statement->execute();
                //fetches all rows from a result set
                $eligibleSqlStatus = $statement->fetch();           // print_r($result);
                //return $result;
                $statement->closeCursor();
                
                if($eligibleSqlStatus)
                {
                    return $status = "Eligible";
                }
                else 
                {
                    return $status = "Not Eligible";
                }
              
            }
        }
        catch(PDOException $e)
        {
                $error = $e->getMessage();
                display_db_error(); //found in connection.php, redirects page to error.php
        }
        
    }
    
?>