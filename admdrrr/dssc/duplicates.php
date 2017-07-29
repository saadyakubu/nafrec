<?php

//$surname_v= 'Adele'; $firstname_v= 'Yolanda';
$name_v = htmlspecialchars($_GET['Name']);//'Adele Moana Yolanda';
$state_v = htmlspecialchars($_GET['State']);
$lga_v = htmlspecialchars($_GET['LGA']);
//echo print_r($_POST['State']);
//echo $name_v; 
//exit();
//echo $name_v." ".$state_v." ".$lga_v; exit();
?>
<link rel="stylesheet" href="../css/admin.css">
<?php require_once '../../global/connection.php';
      require_once '../templates/top.php'; ?>
        
            <!--Main Content-->
            
	<?php //include_once("../global/nav.php")?> 
	<div class="container-fluid">
            <div class="starter-template">
                
                <div class="page-header">
                    
                    <!--<h2>Possible Duplicate Records for <?php //echo $surname_v." ".$firstname_v;?></h2>-->
                    <h2>Possible Duplicate Records for <?php echo $name_v;?></h2>
                </div>
                  
                <!-- Responsive table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-condensed" id="dynamic-table">					
                        <thead>
                                <tr>                                    
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>State</th>
                                    <th>LGA</th>
                                    <th>Passport</th>
                                </tr>
                        </thead>

                        <?php
                        global $centrename;
                        //$centrename= $_POST['centre_selection'];
                        /*if(empty($_POST['centre_selection']))
                        {
                            $centrename = '0';//echo 'Empty Selection';
                        }
                        else
                        {
                            $centrename= $_POST['centre_selection'];
                        }*/
                        //$surname_v= $_POST['surname']; $middlename_v= $_POST['middle']; $firstname_v= $_POST['firstname'];
                        //$state_v == $_POST['state']; $lga_v = $_POST['lga'];
                        //$surname_v= 'Adele'; $firstname_v= 'Yolanda';
                        //$state_v = 'Delta'; $lga_v = 'Cakewalk';
                        
                        //make sure file is only required once,
                        //fail causes error that stops remainder of page from processing
                        require_once "../../global/connection.php";

                        //pull in function library
                        require_once "../../global/functions.php";
                        
                        //call UDF (user-defined function)
                        $results = getDuplicatesDetails($name_v,$state_v, $lga_v); //getDuplicatesDetails($surname_v, $firstname_v, $state_v, $lga_v);

                        //for testing
                        //print_r($results['0']);
                        //exit();

                        //loop through each row
                        foreach($results as $result):
                                //get petstore information
                        ?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($result['name']); ?></td>
                                <td><?php echo htmlspecialchars($result['dob']); ?></td>
                                 <td><?php echo htmlspecialchars($result['email']); ?></td>
                                <td><?php echo htmlspecialchars($result['mobile']); ?></td>
                                <td><?php echo htmlspecialchars($result['state']); ?></td>
                                <td><?php echo htmlspecialchars($result['lga']); ?></td>                           
                                <td><img src ="../../documents/passport/dssc/<?php echo htmlspecialchars($result['passport_url']); ?>" 
                                         alt="Passport Img" style="width: 100px; height: 100px; border: 1px solid #1a3b7f;"/></td>                                     
                            </tr>

                        <?php 
                                //$result = $statement->fetch();
                        endforeach;	
                        $db= null;
                        ?>

                    </table>
                </div> <!-- end table-responsive -->
                
                
                <br/>
                <?php //include_once "../global/footer.php"; ?>
			
            </div><!-- end starter-template -->
	</div><!-- end container -->
	
        <!--<script src="../../js/includes_js.php" type="text/javascript"></script>-->
	<?php include_once '../../js/includes_js.php'; ?>
        <!--<script src="../../js/download.js" type="text/javascript"></script>-->
        
	     

        
        <?php require_once '../templates/bottom.php'; ?>